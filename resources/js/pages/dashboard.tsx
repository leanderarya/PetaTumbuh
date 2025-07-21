'use client';

import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import L, { LatLngExpression } from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { Baby, BarChart3, HeartPulse, MapPin, Star, User } from 'lucide-react';
import React, { memo, useEffect, useRef, useState } from 'react';
import CountUp from 'react-countup';

// --- Type Definitions ---
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

type Stats = {
    total: number;
    avg_usia: number;
    stunting: number;
};

type DusunStat = {
    desa: string;
    jumlah_anak: number;
};

interface InteractiveMapProps {
    center: LatLngExpression;
    zoom: number;
    markers: Anak[];
}

// --- Leaflet Icon ---
const redIcon = new L.Icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
});

const warnaDusun = [
    'from-blue-200 to-blue-100',
    'from-pink-100 to-pink-50',
    'from-green-100 to-green-50',
    'from-yellow-100 to-yellow-50',
    'from-cyan-100 to-cyan-50',
    'from-violet-100 to-violet-50',
];

// =================================================================================
// KOMPONEN KARTU STATISTIK
// =================================================================================
const StatCard: React.FC<{ icon: React.ElementType; title: string; value: string | number; unit: string }> = ({ icon: Icon, title, value, unit }) => (
    <div className="flex items-center rounded-xl bg-white p-4 shadow-lg">
        <div className="mr-4 rounded-full bg-blue-100 p-3">
            <Icon className="h-6 w-6 text-blue-600" />
        </div>
        <div>
            <p className="text-sm font-medium text-gray-500">{title}</p>
            <p className="text-2xl font-bold text-gray-800">
                {value} <span className="text-base font-normal">{unit}</span>
            </p>
        </div>
    </div>
);

// =================================================================================
// KOMPONEN KARTU STATISTIK DUSUN
// =================================================================================
const DusunStatCard: React.FC<{ stat: DusunStat; isInView: boolean; idx: number }> = memo(({ stat, isInView, idx }) => (
    <div
        className={`rounded-xl bg-gradient-to-br ${warnaDusun[idx % warnaDusun.length]} border-2 border-white p-5 text-center shadow-lg transition-transform duration-300 hover:scale-105`}
    >
        <div className="mb-2 flex items-center justify-center gap-1">
            <User className="h-5 w-5 text-blue-600" />
            <span className="font-semibold text-blue-800">{stat.desa}</span>
            {stat.jumlah_anak > 20 && (
                <span className="ml-2 flex animate-bounce items-center gap-1 rounded-full bg-yellow-400 px-2 py-0.5 text-xs font-bold text-white">
                    <Star className="h-3 w-3" /> Banyak!
                </span>
            )}
        </div>
        <div className="animate-fade-in text-4xl font-extrabold text-blue-800 drop-shadow-md">
            {isInView ? <CountUp start={0} end={stat.jumlah_anak} duration={2} separator="," /> : '0'}
        </div>
        <p className="mt-2 text-xs text-gray-700">Anak terdata</p>
    </div>
));

// =================================================================================
// KOMPONEN PETA INTERAKTIF
// =================================================================================
const InteractiveMap: React.FC<InteractiveMapProps> = ({ center, zoom, markers }) => {
    const mapContainerRef = useRef<HTMLDivElement>(null);
    const mapRef = useRef<L.Map | null>(null);

    useEffect(() => {
        if (mapContainerRef.current && !mapRef.current) {
            const map = L.map(mapContainerRef.current).setView(center, zoom);
            mapRef.current = map;
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri',
            }).addTo(map);
        }

        if (mapRef.current && Array.isArray(markers)) {
            mapRef.current.eachLayer((layer) => {
                if (layer instanceof L.Marker) {
                    mapRef.current?.removeLayer(layer);
                }
            });

            markers.forEach((anak) => {
                if (anak.latitude && anak.longitude) {
                    const position: LatLngExpression = [parseFloat(anak.latitude), parseFloat(anak.longitude)];
                    L.marker(position, { icon: redIcon }).addTo(mapRef.current!).bindPopup(`<b>${anak.nama}</b><br>Status Gizi: ${anak.status_gizi}`);
                }
            });
        }
    }, [center, zoom, markers]);

    return <div ref={mapContainerRef} className="z-0 h-full w-full rounded-b-xl" />;
};

// =================================================================================
// KOMPONEN UTAMA HALAMAN DASHBOARD
// =================================================================================
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ anakData, stats, dusunStats }: { anakData?: Anak[]; stats: Stats; dusunStats: DusunStat[] }) {
    const [isInView, setIsInView] = useState(false);
    const dusunStatsRef = useRef<HTMLDivElement | null>(null);
    const anakStunting = anakData?.filter((anak) => anak.status_gizi === 'Bawah Garis Merah' || anak.status_gizi === 'Kurang') ?? [];

    // Observer untuk animasi CountUp pada statistik dusun
    useEffect(() => {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    setIsInView(true);
                    observer.unobserve(entry.target);
                }
            },
            { threshold: 0.1 },
        );
        const currentRef = dusunStatsRef.current;
        if (currentRef) observer.observe(currentRef);
        return () => {
            if (currentRef) observer.unobserve(currentRef);
        };
    }, []);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-2 md:p-4">
                {/* Statistik Utama */}
                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <StatCard icon={Baby} title="Total Anak Terdata" value={stats.total} unit="Anak" />
                    <StatCard icon={BarChart3} title="Rata-rata Usia" value={stats.avg_usia} unit="Bulan" />
                    <StatCard icon={HeartPulse} title="Kasus Gizi Kurang/Stunting" value={stats.stunting} unit="Kasus" />
                </div>

                {/* Info + Peta */}
                <div className="grid grid-cols-1 gap-4 lg:grid-cols-5">
                    {/* Info Card */}
                    <div
                        className="relative flex min-h-[240px] flex-col justify-between overflow-hidden rounded-xl bg-cover bg-center p-5 text-white shadow-2xl sm:p-8 lg:col-span-2"
                        style={{ backgroundImage: "url('/storage/pake.png')" }}
                    >
                        <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-blue-900/60 to-transparent" />
                        <div className="relative z-10">
                            <div className="mb-4 w-fit rounded-full bg-white/20 p-3 backdrop-blur-sm">
                                <HeartPulse className="h-8 w-8 text-white" />
                            </div>
                            <h2 className="text-2xl font-bold md:text-3xl">Selamat Datang di Dashboard Peta Tumbuh</h2>
                        </div>
                        <p className="relative z-10 mt-2 text-justify text-sm leading-relaxed opacity-90 md:text-base">
                            Halaman ini memberikan ringkasan visual dari data persebaran anak di wilayah Anda. Gunakan peta di samping untuk melihat
                            lokasi setiap anak yang terdata.
                        </p>
                    </div>

                    {/* Map Card */}
                    <div className="flex h-[280px] flex-col rounded-xl bg-white shadow-xl md:h-[360px] lg:col-span-3 lg:h-auto">
                        <div className="border-b p-4 md:p-6">
                            <h2 className="flex items-center gap-2 text-xl font-bold text-gray-800 md:text-2xl">
                                <MapPin className="text-blue-600" />
                                Peta Persebaran Anak
                            </h2>
                        </div>
                        <div className="flex-grow p-2 md:p-6">
                            {anakData && anakData.length > 0 ? (
                                <div className="h-[220px] w-full overflow-hidden rounded-b-xl md:h-[280px] lg:h-[380px]">
                                    <InteractiveMap center={[-7.079495, 111.194213]} zoom={15} markers={anakStunting} />
                                </div>
                            ) : (
                                <div className="flex h-full w-full items-center justify-center rounded-lg bg-gray-100">
                                    <p className="text-center text-gray-500">Data anak tidak tersedia.</p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Statistik per Dusun */}
                <div ref={dusunStatsRef} className="rounded-xl bg-white p-4 shadow-xl md:p-8">
                    <h2 className="mb-4 text-center text-xl font-bold text-gray-800 md:mb-6 md:text-2xl">Jumlah Anak Terdata per Dusun</h2>
                    <div className="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
                        {dusunStats.map((stat, idx) => (
                            <DusunStatCard key={stat.desa} stat={stat} isInView={isInView} idx={idx} />
                        ))}
                    </div>
                </div>

                <footer className="mt-auto border-t bg-white px-4 pt-8 pb-4 text-center text-sm text-gray-500">
                    <div className="mx-auto flex max-w-3xl flex-col items-center gap-2">
                        <img src="/storage/logo.png" alt="Logo P3SA" className="mb-1 h-9 w-9 object-contain" />
                        <div className="font-semibold text-gray-700">Tambuh Kalangdosari</div>
                        <div className="mb-2 text-xs text-gray-400">Peta Tumbuh Kalangdosari</div>
                        <div className="flex justify-center gap-4 text-xs">
                            <a href={route('dashboard')} className="transition hover:text-blue-500">
                                Dashboard
                            </a>
                            <a href={route('children.index')} className="transition hover:text-blue-500">
                                Daftar Anak
                            </a>
                            <a href={route('ebooks.petugasIndex')} className="transition hover:text-blue-500">
                                Manajemen E-Book
                            </a>
                            <a href={route('artikel.create')} className="transition hover:text-blue-500">
                                Manajemen Artikel
                            </a>
                        </div>
                        <p className="mt-3 text-xs text-gray-400">&copy; 2025 Tambuh Kalangdosari. Hak Cipta Dilindungi.</p>
                    </div>
                </footer>
            </div>
        </AppLayout>
    );
}
