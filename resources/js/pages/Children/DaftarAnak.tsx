import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import React, { useEffect, useState } from 'react';
import { MapContainer, Marker, TileLayer, useMapEvents } from 'react-leaflet';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
});

function ClickHandler({ setData }: { setData: any }) {
    useMapEvents({
        click(e) {
            const { lat, lng } = e.latlng;
            setData('latitude', lat.toFixed(7));
            setData('longitude', lng.toFixed(7));
        },
    });
    return null;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Anak', href: '/anak' },
];

export default function DaftarAnak({ children }: { children: any[] }) {
    const [initialPosition, setInitialPosition] = useState<[number, number]>([-7.0794952064246575, 111.19421399589754]);
    useEffect(() => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    setInitialPosition([latitude, longitude]);
                },
                (error) => {
                    console.warn('Lokasi tidak diizinkan:', error.message);
                },
            );
        }
    }, []);
    const { data, setData, post, processing, reset } = useForm({
        nama: '',
        usia: '',
        berat_badan: '',
        tinggi_badan: '',
        desa: '',
        status_gizi: '',
        latitude: '',
        longitude: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/anak', {
            onSuccess: () => reset(),
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Anak Stunting" />
            <div className="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4">
                {/* Form Input */}
                <form onSubmit={submit} className="grid grid-cols-1 gap-6 rounded-xl border border-gray-200 bg-white p-6 shadow md:grid-cols-2">
                    {[
                        { label: 'Nama Anak', name: 'nama', type: 'text', placeholder: 'Misalnya: Rani' },
                        { label: 'Usia (bulan)', name: 'usia', type: 'number', placeholder: 'Contoh: 18' },
                        { label: 'Berat Badan (kg)', name: 'berat_badan', type: 'number', placeholder: 'Contoh: 9.5' },
                        { label: 'Tinggi Badan (cm)', name: 'tinggi_badan', type: 'number', placeholder: 'Contoh: 78' },
                        { label: 'Desa', name: 'desa', type: 'text', placeholder: 'Misalnya: Pulau Rambai' },
                        { label: 'Status Gizi', name: 'status_gizi', type: 'text', placeholder: 'Normal / Ringan / Sedang / Berat' },
                        { label: 'Latitude (opsional)', name: 'latitude', type: 'text', placeholder: '-0.358...' },
                        { label: 'Longitude (opsional)', name: 'longitude', type: 'text', placeholder: '101.246...' },
                    ].map((field) => (
                        <div key={field.name} className="flex flex-col">
                            <label htmlFor={field.name} className="mb-1 font-medium text-gray-700">
                                {field.label}
                            </label>
                            <input
                                id={field.name}
                                type={field.type}
                                placeholder={field.placeholder}
                                value={data[field.name as keyof typeof data]}
                                onChange={(e) => setData(field.name as keyof typeof data, e.target.value)}
                                className="rounded-md border border-gray-300 px-4 py-2 transition focus:ring focus:ring-blue-300 focus:outline-none"
                            />
                        </div>
                    ))}

                    <div className="text-right md:col-span-2">
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700"
                        >
                            Simpan Data
                        </button>
                    </div>
                </form>

                {/* Peta Lokasi */}
                <div className="overflow-hidden rounded-xl border bg-white shadow">
                    <h2 className="mb-2 px-4 pt-4 text-lg font-semibold text-gray-700">📍 Pilih Lokasi Anak di Peta</h2>
                    <MapContainer center={initialPosition} zoom={15} scrollWheelZoom={true} className="h-[400px] w-full">
                        <TileLayer attribution="&copy; OpenStreetMap" url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
                        <ClickHandler setData={setData} />
                        {data.latitude && data.longitude && <Marker position={[parseFloat(data.latitude), parseFloat(data.longitude)]} />}
                    </MapContainer>
                </div>

                {/* Tabel Anak */}
                <div className="overflow-auto rounded-xl border shadow">
                    <table className="w-full text-left text-sm">
                        <thead className="bg-gray-100 text-gray-600 uppercase">
                            <tr>
                                <th className="px-4 py-2">Nama</th>
                                <th className="px-4 py-2">Usia</th>
                                <th className="px-4 py-2">BB / TB</th>
                                <th className="px-4 py-2">Desa</th>
                                <th className="px-4 py-2">Status Gizi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {children.length === 0 ? (
                                <tr>
                                    <td colSpan={5} className="py-4 text-center text-gray-500">
                                        Belum ada data
                                    </td>
                                </tr>
                            ) : (
                                children.map((anak, i) => (
                                    <tr key={i} className="border-b hover:bg-gray-50">
                                        <td className="px-4 py-2">{anak.nama}</td>
                                        <td className="px-4 py-2">{anak.usia} bln</td>
                                        <td className="px-4 py-2">
                                            {anak.berat_badan} kg / {anak.tinggi_badan} cm
                                        </td>
                                        <td className="px-4 py-2">{anak.desa}</td>
                                        <td className="px-4 py-2">{anak.status_gizi}</td>
                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
    );
}
