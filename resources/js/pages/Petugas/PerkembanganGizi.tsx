import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import React, { useEffect, useState } from 'react';
import { MapContainer, Marker, TileLayer } from 'react-leaflet';
import Swal from 'sweetalert2';

type Anak = {
    id: number;
    nama: string;
    usia: number;
    berat_badan: number;
    tinggi_badan: number;
    desa: string;
    status_gizi: string;
    latitude?: string;
    longitude?: string;
};

type FormData = {
    anak_id: string;
    berat_badan: string;
    tinggi_badan: string;
    status_gizi: string;
    catatan: string;
    tanggal_pemeriksaan: string;
    latitude: string;
    longitude: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Perkembangan Gizi', href: '/perkembangangizi' },
];

const redIcon = new L.Icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
});

export default function PerkembanganGizi(props: { children: Anak[] }) {
    const { children } = props;
    const [selectedChild, setSelectedChild] = useState<Anak | null>(null); // To hold the selected child
    const [initialPosition, setInitialPosition] = useState<[number, number]>([-7.0794952, 111.1942139]); // Default position for map center

    const { data, setData, post, processing } = useForm<FormData>({
        anak_id: '',
        berat_badan: '',
        tinggi_badan: '',
        status_gizi: '',
        catatan: '',
        tanggal_pemeriksaan: '',
        latitude: '',
        longitude: '',
    });

    // Update map and form data when a child is selected
    useEffect(() => {
        if (selectedChild && selectedChild.latitude && selectedChild.longitude) {
            setData('latitude', selectedChild.latitude);
            setData('longitude', selectedChild.longitude);
            setInitialPosition([parseFloat(selectedChild.latitude), parseFloat(selectedChild.longitude)]);
        }
    }, [selectedChild, setData]);

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        post('/perkembangan-gizi', {
            onSuccess: () => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Perkembangan gizi anak berhasil diperbarui.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });
            },
            onError: () => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memperbarui data.',
                    icon: 'error',
                    showConfirmButton: true,
                });
            },
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Perkembangan Gizi Anak" />
            <div className="flex flex-1 flex-col gap-6 overflow-x-auto p-4">
                {/* Form Input */}
                <form onSubmit={handleSubmit} className="grid grid-cols-1 gap-6 rounded-xl border border-gray-200 bg-white p-6 shadow md:grid-cols-2">
                    <div>
                        <label htmlFor="anak_id" className="block text-sm font-medium text-gray-700">
                            Pilih Anak
                        </label>
                        <select
                            id="anak_id"
                            value={data.anak_id}
                            onChange={(e) => {
                                const selected = children.find((child) => child.id.toString() === e.target.value);
                                setSelectedChild(selected || null); // Update selected child
                                setData('anak_id', e.target.value); // Update anak_id in form data
                            }}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">Pilih Anak</option>
                            {children.map((child) => (
                                <option key={child.id} value={child.id}>
                                    {child.nama} - {child.desa}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label htmlFor="berat_badan" className="block text-sm font-medium text-gray-700">
                                Berat Badan (kg)
                            </label>
                            <input
                                type="number"
                                id="berat_badan"
                                value={data.berat_badan}
                                onChange={(e) => setData('berat_badan', e.target.value)}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div>
                            <label htmlFor="tinggi_badan" className="block text-sm font-medium text-gray-700">
                                Tinggi Badan (cm)
                            </label>
                            <input
                                type="number"
                                id="tinggi_badan"
                                value={data.tinggi_badan}
                                onChange={(e) => setData('tinggi_badan', e.target.value)}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>
                    </div>

                    <div>
                        <label htmlFor="status_gizi" className="block text-sm font-medium text-gray-700">
                            Status Gizi
                        </label>
                        <input
                            type="text"
                            id="status_gizi"
                            value={data.status_gizi}
                            onChange={(e) => setData('status_gizi', e.target.value)}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label htmlFor="tanggal_pemeriksaan" className="block text-sm font-medium text-gray-700">
                            Tanggal Pemeriksaan
                        </label>
                        <input
                            type="date"
                            id="tanggal_pemeriksaan"
                            value={data.tanggal_pemeriksaan}
                            onChange={(e) => setData('tanggal_pemeriksaan', e.target.value)}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label htmlFor="catatan" className="block text-sm font-medium text-gray-700">
                            Catatan
                        </label>
                        <textarea
                            id="catatan"
                            value={data.catatan}
                            onChange={(e) => setData('catatan', e.target.value)}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>

                    <div className="md:col-span-2">
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700"
                        >
                            {processing ? 'Mengirim...' : 'Simpan Perkembangan Gizi'}
                        </button>
                    </div>
                </form>

                {/* Peta */}
                <div className="mt-6">
                    <h2 className="mb-4 text-lg font-semibold text-gray-800">📍 Lokasi Anak di Peta</h2>
                    <MapContainer center={initialPosition} zoom={15} scrollWheelZoom className="h-[400px] w-full rounded-md">
                        <TileLayer
                            url="https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
                            attribution='Tiles © <a href="https://www.esri.com/en-us/home" target="_blank" rel="noreferrer">Esri</a>'
                        />
                        {selectedChild && selectedChild.latitude && selectedChild.longitude && (
                            <Marker position={[parseFloat(selectedChild.latitude), parseFloat(selectedChild.longitude)]} icon={redIcon} />
                        )}
                    </MapContainer>
                </div>
            </div>
        </AppLayout>
    );
}
