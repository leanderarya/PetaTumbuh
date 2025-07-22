'use client';

import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { Eye, FilePenLine, Trash2 } from 'lucide-react';
import React, { useEffect, useMemo, useRef, useState } from 'react';
import { MapContainer, Marker, TileLayer, useMapEvents } from 'react-leaflet';
import Swal from 'sweetalert2';

// --- Type Definitions (Sesuai dengan data dari Controller) ---
type Anak = {
    id: number;
    nama: string;
    nama_ortu?: string;
    tanggal_lahir: string;
    usia: number;
    jenis_kelamin: string;
    desa: string;
    berat_badan: number;
    tinggi_badan: number;
    lingkar_lengan?: number;
    lingkar_kepala?: number;
    status_gizi: string;
    latitude?: string;
    longitude?: string;
    updated_at?: string;
};

type FormData = {
    nama: string;
    nama_ortu: string;
    tanggal_lahir: string;
    jenis_kelamin: string;
    desa: string;
    berat_badan: string;
    tinggi_badan: string;
    lingkar_lengan: string;
    lingkar_kepala: string;
    status_gizi: string;
    latitude: string;
    longitude: string;
};

// --- Leaflet Icon Fix ---
delete (L.Icon.Default.prototype as any)._getIconUrl;
L.Icon.Default.mergeOptions({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
});

const redIcon = new L.Icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
});

// --- Helper Components ---
function ClickHandler({ setData }: { setData: (field: keyof FormData, value: string) => void }) {
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
    { title: 'Dashboard', href: route('dashboard') },
    { title: 'Data Anak', href: route('children.index') },
];

export default function DaftarAnakPage({ children }: { children: Anak[] }) {
    const [initialPosition, setInitialPosition] = useState<[number, number]>([-7.0794952, 111.1942139]);
    const [isMapOpen, setIsMapOpen] = useState(false);
    const [selectedChild, setSelectedChild] = useState<Anak | null>(null);
    const [isDetailOpen, setIsDetailOpen] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [editId, setEditId] = useState<number | null>(null);
    const formRef = useRef<HTMLFormElement | null>(null);

    // --- State untuk Filter dan Paginasi ---
    const [search, setSearch] = useState('');
    const [dusunFilter, setDusunFilter] = useState(''); // State baru untuk filter dusun
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;

    // --- Logika Filter dan Paginasi ---
    const filteredData = useMemo(() => {
        return children.filter((anak) => {
            const searchMatch = anak.nama.toLowerCase().includes(search.toLowerCase());
            const dusunMatch = !dusunFilter || anak.desa === dusunFilter;
            return searchMatch && dusunMatch;
        });
    }, [children, search, dusunFilter]);

    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    const paginatedData = filteredData.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);

    // Ambil daftar dusun unik dari data untuk dropdown filter
    const dusunList = useMemo(() => [...new Set(children.map((anak) => anak.desa))].sort(), [children]);

    const { data, setData, post, put, processing, reset, errors } = useForm<FormData>({
        nama: '',
        nama_ortu: '',
        tanggal_lahir: '',
        jenis_kelamin: '',
        desa: '',
        berat_badan: '',
        tinggi_badan: '',
        lingkar_lengan: '',
        lingkar_kepala: '',
        status_gizi: '',
        latitude: '',
        longitude: '',
    });

    useEffect(() => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    setInitialPosition([latitude, longitude]);
                    if (!data.latitude && !data.longitude && !isEditing) {
                        setData('latitude', latitude.toFixed(7));
                        setData('longitude', longitude.toFixed(7));
                    }
                },
                (error) => console.warn('Izin lokasi ditolak:', error.message),
            );
        }
    }, [isEditing]);

    const openDetailModal = (child: Anak) => {
        setSelectedChild(child);
        setIsDetailOpen(true);
    };

    function toDateInputString(dateStr: string): string {
        if (!dateStr) return '';
        if (dateStr.includes('T')) return dateStr.split('T')[0];
        if (/^\d{4}-\d{2}-\d{2}$/.test(dateStr)) return dateStr;
        try {
            const dateObj = new Date(dateStr);
            return dateObj.toISOString().split('T')[0];
        } catch {
            return '';
        }
    }

    const handleEdit = (anak: Anak) => {
        setEditId(anak.id);
        setIsEditing(true);
        setData({
            nama: anak.nama,
            nama_ortu: anak.nama_ortu ?? '',
            tanggal_lahir: toDateInputString(anak.tanggal_lahir),
            jenis_kelamin: anak.jenis_kelamin,
            desa: anak.desa,
            berat_badan: anak.berat_badan.toString(),
            tinggi_badan: anak.tinggi_badan.toString(),
            lingkar_lengan: anak.lingkar_lengan?.toString() ?? '',
            lingkar_kepala: anak.lingkar_kepala?.toString() ?? '',
            status_gizi: anak.status_gizi,
            latitude: anak.latitude ?? '',
            longitude: anak.longitude ?? '',
        });
        formRef.current?.scrollIntoView({ behavior: 'smooth' });
    };

    const resetForm = () => {
        reset();
        setEditId(null);
        setIsEditing(false);
    };

    const handleDelete = (id: number) => {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('children.destroy', id), {
                    onSuccess: () => Swal.fire('Terhapus!', 'Data anak telah dihapus.', 'success'),
                });
            }
        });
    };

    const submit: React.FormEventHandler<HTMLFormElement> = (e) => {
        e.preventDefault();

        if (
            !data.nama.trim() ||
            !data.tanggal_lahir.trim() ||
            !data.jenis_kelamin.trim() ||
            !data.desa.trim() ||
            !data.berat_badan.trim() ||
            !data.tinggi_badan.trim() ||
            !data.status_gizi.trim()
        ) {
            Swal.fire({
                icon: 'error',
                title: 'Form Belum Lengkap!',
                text: 'Silakan lengkapi semua data yang wajib diisi (nama, tanggal lahir, jenis kelamin, dusun, BB, TB, status gizi).',
                confirmButtonColor: '#2563eb',
            });
            return;
        }

        const onSuccess = () => {
            resetForm();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: `Data berhasil di${isEditing ? 'perbarui' : 'simpan'}!`,
                showConfirmButton: false,
                timer: 3000,
            });
        };

        if (isEditing && editId) {
            put(route('children.update', editId!), {
                ...data,
                onSuccess,
            });
        } else {
            post(route('children.store'), {
                ...data,
                onSuccess,
            });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Anak Stunting" />
            <div className="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4">
                {/* --- Form Input / Edit --- */}
                <form ref={formRef} onSubmit={submit} className="grid grid-cols-1 gap-8 rounded-3xl border bg-white/80 p-8 shadow-lg md:grid-cols-3">
                    <h2 className="mb-2 flex items-center gap-2 text-2xl font-extrabold text-blue-800 md:col-span-3">
                        {isEditing ? '✏️ Edit Data Anak' : '🧒 Input Data Anak Baru'}
                    </h2>
                    {/* Kolom 1 */}
                    <div className="flex flex-col gap-6">
                        <div>
                            <label htmlFor="nama" className="mb-1 block font-semibold text-gray-700">
                                Nama Anak <span className="text-red-500">*</span>
                            </label>
                            <input
                                id="nama"
                                type="text"
                                placeholder="Misal: Aditya"
                                value={data.nama}
                                onChange={(e) => setData('nama', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                            <span className="text-xs text-gray-500">Isi dengan nama lengkap anak.</span>
                        </div>
                        <div>
                            <label htmlFor="nama_ortu" className="mb-1 block font-semibold text-gray-700">
                                Nama Orang Tua
                            </label>
                            <input
                                id="nama_ortu"
                                type="text"
                                placeholder="Misal: Fahmi Muzair, Siti Markonah"
                                value={data.nama_ortu}
                                onChange={(e) => setData('nama_ortu', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                            <span className="text-xs text-gray-500">Opsional, diisi jika ada.</span>
                        </div>
                        <div>
                            <label htmlFor="tanggal_lahir" className="mb-1 block font-semibold text-gray-700">
                                Tanggal Lahir <span className="text-red-500">*</span>
                            </label>
                            <input
                                id="tanggal_lahir"
                                type="date"
                                placeholder="yyyy-mm-dd"
                                value={data.tanggal_lahir}
                                onChange={(e) => setData('tanggal_lahir', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <div>
                            <label htmlFor="jenis_kelamin" className="mb-1 block font-semibold text-gray-700">
                                Jenis Kelamin <span className="text-red-500">*</span>
                            </label>
                            <select
                                id="jenis_kelamin"
                                value={data.jenis_kelamin}
                                onChange={(e) => setData('jenis_kelamin', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">Pilih Opsi</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    {/* Kolom 2 */}
                    <div className="flex flex-col gap-6">
                        <div>
                            <label htmlFor="berat_badan" className="mb-1 block font-semibold text-gray-700">
                                Berat Badan (kg) <span className="text-red-500">*</span>
                            </label>
                            <input
                                id="berat_badan"
                                type="number"
                                step="0.1"
                                min="0"
                                placeholder="Misal: 9.5"
                                value={data.berat_badan}
                                onChange={(e) => setData('berat_badan', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <div>
                            <label htmlFor="tinggi_badan" className="mb-1 block font-semibold text-gray-700">
                                Tinggi/Panjang Badan (cm) <span className="text-red-500">*</span>
                            </label>
                            <input
                                id="tinggi_badan"
                                type="number"
                                step="0.1"
                                min="0"
                                placeholder="Misal: 74.5"
                                value={data.tinggi_badan}
                                onChange={(e) => setData('tinggi_badan', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <div>
                            <label htmlFor="lingkar_lengan" className="mb-1 block font-semibold text-gray-700">
                                Lingkar Lengan (cm)
                            </label>
                            <input
                                id="lingkar_lengan"
                                type="number"
                                step="0.1"
                                min="0"
                                placeholder="Misal: 14.0"
                                value={data.lingkar_lengan}
                                onChange={(e) => setData('lingkar_lengan', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <div>
                            <label htmlFor="lingkar_kepala" className="mb-1 block font-semibold text-gray-700">
                                Lingkar Kepala (cm)
                            </label>
                            <input
                                id="lingkar_kepala"
                                type="number"
                                step="0.1"
                                min="0"
                                placeholder="Misal: 45.0"
                                value={data.lingkar_kepala}
                                onChange={(e) => setData('lingkar_kepala', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                    </div>
                    {/* Kolom 3 */}
                    <div className="flex flex-col gap-6">
                        <div>
                            <label htmlFor="desa" className="mb-1 block font-semibold text-gray-700">
                                Dusun <span className="text-red-500">*</span>
                            </label>
                            <select
                                id="desa"
                                value={data.desa}
                                onChange={(e) => setData('desa', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">Pilih Dusun</option>
                                {['Dumpil 1', 'Dumpil 2', 'Payasan', 'Kalang', 'Dosari', 'Prakitan'].map((d) => (
                                    <option key={d} value={d}>
                                        {d}
                                    </option>
                                ))}
                            </select>
                        </div>
                        <div>
                            <label htmlFor="status_gizi" className="mb-1 block font-semibold text-gray-700">
                                Status Gizi <span className="text-red-500">*</span>
                            </label>
                            <select
                                id="status_gizi"
                                value={data.status_gizi}
                                onChange={(e) => setData('status_gizi', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">Pilih Status</option>
                                {['Baik', 'Kurang', 'Bawah Garis Merah'].map((s) => (
                                    <option key={s} value={s}>
                                        {s}
                                    </option>
                                ))}
                            </select>
                        </div>
                        <div>
                            <label htmlFor="latitude" className="mb-1 block font-semibold text-gray-700">
                                Latitude
                            </label>
                            <input
                                id="latitude"
                                type="text"
                                placeholder="Klik peta atau isi manual"
                                value={data.latitude}
                                onChange={(e) => setData('latitude', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <div>
                            <label htmlFor="longitude" className="mb-1 block font-semibold text-gray-700">
                                Longitude
                            </label>
                            <input
                                id="longitude"
                                type="text"
                                placeholder="Klik peta atau isi manual"
                                value={data.longitude}
                                onChange={(e) => setData('longitude', e.target.value)}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            />
                        </div>
                        <button
                            type="button"
                            onClick={() => setIsMapOpen(true)}
                            className="rounded-md bg-blue-600 px-4 py-2 font-semibold text-white shadow-sm transition hover:bg-blue-700"
                        >
                            📍 Pilih Lokasi di Peta
                        </button>
                    </div>
                    <div className="flex justify-end gap-4 md:col-span-3">
                        {isEditing && (
                            <button
                                type="button"
                                onClick={resetForm}
                                className="rounded-md border bg-gray-100 px-6 py-2 font-semibold text-gray-700 transition hover:bg-gray-200"
                            >
                                Batal
                            </button>
                        )}
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700 disabled:opacity-50"
                        >
                            {processing ? 'Menyimpan...' : isEditing ? 'Update Data' : 'Simpan Data'}
                        </button>
                    </div>
                </form>

                {/* Modal Peta */}
                {isMapOpen && (
                    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                        <div className="relative w-[90%] max-w-3xl rounded-xl bg-white p-4 shadow-lg">
                            <h2 className="mb-2 text-lg font-semibold">Klik di peta untuk memilih lokasi</h2>
                            <MapContainer center={initialPosition} zoom={15} className="h-[400px] w-full rounded-md">
                                <TileLayer
                                    url="https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
                                    attribution="&copy; Esri"
                                />
                                {data.latitude && data.longitude && (
                                    <Marker position={[parseFloat(data.latitude), parseFloat(data.longitude)]} icon={redIcon} />
                                )}
                                <ClickHandler setData={setData} />
                            </MapContainer>
                            <div className="mt-4 text-right">
                                <button
                                    type="button"
                                    onClick={() => setIsMapOpen(false)}
                                    className="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                                >
                                    Tutup Peta
                                </button>
                            </div>
                        </div>
                    </div>
                )}

                {/* --- Filter & Daftar Anak --- */}
                <div className="overflow-hidden rounded-xl border bg-white shadow">
                    <div className="flex flex-col items-start gap-4 border-b bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <h2 className="text-lg font-semibold text-gray-800">Daftar Anak Terdata</h2>
                        <div className="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                            <input
                                type="text"
                                placeholder="Cari nama anak..."
                                value={search}
                                onChange={(e) => {
                                    setSearch(e.target.value);
                                    setCurrentPage(1);
                                }}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 sm:w-auto"
                            />
                            <select
                                value={dusunFilter}
                                onChange={(e) => {
                                    setDusunFilter(e.target.value);
                                    setCurrentPage(1);
                                }}
                                className="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 sm:w-auto"
                            >
                                <option value="">Semua Dusun</option>
                                {dusunList.map((dusun) => (
                                    <option key={dusun} value={dusun}>
                                        {dusun}
                                    </option>
                                ))}
                            </select>
                        </div>
                    </div>

                    {/* TABEL DESKTOP */}
                    <table className="hidden w-full text-left text-sm md:table">
                        <thead className="bg-gray-50 text-xs text-gray-700 uppercase">
                            <tr>
                                <th className="px-4 py-3">Nama</th>
                                <th className="px-4 py-3">Usia</th>
                                <th className="px-4 py-3">BB / TB</th>
                                <th className="px-4 py-3">Jenis Kelamin</th>
                                <th className="px-4 py-3">Dusun</th>
                                <th className="px-4 py-3">Status Gizi</th>
                                <th className="px-4 py-3">Diperbarui</th>
                                <th className="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {paginatedData.map((anak) => (
                                <tr key={anak.id} className="border-t hover:bg-blue-50/50">
                                    <td className="px-4 py-3 font-semibold">{anak.nama}</td>
                                    <td className="px-4 py-3">{anak.usia} bln</td>
                                    <td className="px-4 py-3">
                                        {anak.berat_badan} kg / {anak.tinggi_badan} cm
                                    </td>
                                    <td className="px-4 py-3">{anak.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</td>
                                    <td className="px-4 py-3">{anak.desa}</td>
                                    <td className="px-4 py-3">
                                        <span
                                            className={`inline-block rounded-full px-3 py-1 text-xs font-semibold ${anak.status_gizi === 'Baik' ? 'bg-green-100 text-green-800' : anak.status_gizi.toLowerCase().includes('kurang') ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'}`}
                                        >
                                            {anak.status_gizi}
                                        </span>
                                    </td>
                                    <td className="px-4 py-3 text-gray-600">
                                        {new Date(anak.updated_at ?? '').toLocaleDateString('id-ID', {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric',
                                        })}
                                    </td>
                                    <td className="space-x-2 px-4 py-3 text-center">
                                        <button
                                            onClick={() => openDetailModal(anak)}
                                            className="rounded bg-blue-500 p-2 text-white hover:bg-blue-600"
                                        >
                                            <Eye size={16} />
                                        </button>
                                        <button onClick={() => handleEdit(anak)} className="rounded bg-yellow-500 p-2 text-white hover:bg-yellow-600">
                                            <FilePenLine size={16} />
                                        </button>
                                        <button onClick={() => handleDelete(anak.id)} className="rounded bg-red-500 p-2 text-white hover:bg-red-600">
                                            <Trash2 size={16} />
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    {/* MOBILE CARD LIST */}
                    <div className="flex flex-col gap-4 p-4 md:hidden">
                        {paginatedData.map((anak) => (
                            <div key={anak.id} className="rounded-lg border bg-gray-50 p-4 shadow-sm">
                                <div className="mb-2 flex items-center justify-between">
                                    <div className="text-lg font-semibold text-gray-800">{anak.nama}</div>
                                    <div className="text-xs text-gray-500">
                                        Diperbarui: {new Date(anak.updated_at ?? '').toLocaleDateString('id-ID', { day: '2-digit', month: 'short' })}
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-gray-700">
                                    <div>
                                        Usia: <span className="font-medium">{anak.usia} bln</span>
                                    </div>
                                    <div>
                                        Dusun: <span className="font-medium">{anak.desa}</span>
                                    </div>
                                    <div>
                                        BB/TB:{' '}
                                        <span className="font-medium">
                                            {anak.berat_badan} kg / {anak.tinggi_badan} cm
                                        </span>
                                    </div>
                                    <div>
                                        JK: <span className="font-medium">{anak.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</span>
                                    </div>
                                    <div className="col-span-2">
                                        Status Gizi: <span className="font-bold">{anak.status_gizi}</span>
                                    </div>
                                </div>
                                <div className="mt-3 flex justify-end gap-2 border-t pt-3">
                                    <button onClick={() => openDetailModal(anak)} className="rounded bg-blue-500 p-2 text-white hover:bg-blue-600">
                                        <Eye size={16} />
                                    </button>
                                    <button onClick={() => handleEdit(anak)} className="rounded bg-yellow-500 p-2 text-white hover:bg-yellow-600">
                                        <FilePenLine size={16} />
                                    </button>
                                    <button onClick={() => handleDelete(anak.id)} className="rounded bg-red-500 p-2 text-white hover:bg-red-600">
                                        <Trash2 size={16} />
                                    </button>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* PAGINATION */}
                    {totalPages > 1 && (
                        <div className="flex flex-col items-center justify-between gap-2 border-t px-4 py-3 text-sm text-gray-600 md:flex-row">
                            <span>
                                Halaman {currentPage} dari {totalPages}
                            </span>
                            <div className="inline-flex items-center -space-x-px">
                                <button
                                    onClick={() => setCurrentPage((p) => Math.max(p - 1, 1))}
                                    disabled={currentPage === 1}
                                    className="rounded-l-md border px-3 py-1 hover:bg-gray-100 disabled:opacity-40"
                                >
                                    Sebelumnya
                                </button>
                                <button
                                    onClick={() => setCurrentPage((p) => Math.min(p + 1, totalPages))}
                                    disabled={currentPage === totalPages}
                                    className="rounded-r-md border px-3 py-1 hover:bg-gray-100 disabled:opacity-40"
                                >
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    )}
                </div>

                {/* MODAL DETAIL */}
                {isDetailOpen && selectedChild && (
                    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                        <div className="relative w-full max-w-lg rounded-xl bg-white p-6 shadow-lg">
                            <h2 className="mb-4 text-xl font-bold text-blue-800">Detail Data Anak</h2>
                            <div className="space-y-2 text-sm text-gray-800">
                                <div>
                                    <b>Nama:</b> {selectedChild.nama}
                                </div>
                                <div>
                                    <b>Nama Orang Tua:</b> {selectedChild.nama_ortu || '-'}
                                </div>
                                <div>
                                    <b>Tanggal Lahir:</b> {selectedChild.tanggal_lahir}
                                </div>
                                <div>
                                    <b>Usia:</b> {selectedChild.usia} bln
                                </div>
                                <div>
                                    <b>Jenis Kelamin:</b> {selectedChild.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                                </div>
                                <div>
                                    <b>Dusun:</b> {selectedChild.desa}
                                </div>
                                <div>
                                    <b>Berat Badan:</b> {selectedChild.berat_badan} kg
                                </div>
                                <div>
                                    <b>Tinggi Badan:</b> {selectedChild.tinggi_badan} cm
                                </div>
                                <div>
                                    <b>Lingkar Lengan:</b> {selectedChild.lingkar_lengan ?? '-'}
                                </div>
                                <div>
                                    <b>Lingkar Kepala:</b> {selectedChild.lingkar_kepala ?? '-'}
                                </div>
                                <div>
                                    <b>Status Gizi:</b> {selectedChild.status_gizi}
                                </div>
                                <div>
                                    <b>Latitude:</b> {selectedChild.latitude ?? '-'}
                                </div>
                                <div>
                                    <b>Longitude:</b> {selectedChild.longitude ?? '-'}
                                </div>
                            </div>
                            {/* PETANYA DI SINI */}
                            {selectedChild.latitude && selectedChild.longitude && (
                                <div className="mt-4 overflow-hidden rounded-lg">
                                    <MapContainer
                                        center={[parseFloat(selectedChild.latitude), parseFloat(selectedChild.longitude)]}
                                        zoom={16}
                                        style={{ height: '250px', width: '100%' }}
                                        scrollWheelZoom={false}
                                    >
                                        <TileLayer
                                            url="https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
                                            attribution="&copy; Esri"
                                        />
                                        <Marker position={[parseFloat(selectedChild.latitude), parseFloat(selectedChild.longitude)]} icon={redIcon} />
                                    </MapContainer>
                                </div>
                            )}
                            <div className="mt-6 text-right">
                                <button
                                    onClick={() => setIsDetailOpen(false)}
                                    className="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                                >
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
