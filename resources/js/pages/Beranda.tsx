'use client';

import { Head, Link } from '@inertiajs/react';
import { Menu, X } from 'lucide-react';
import React, { memo, useEffect, useRef, useState } from 'react';
import CountUp from 'react-countup';

type DusunStat = { desa: string; jumlah_anak: number };
type ArtikelPreview = { id: number; title: string; description: string; image: string; date: string };

const SlideshowWithDescription: React.FC = () => {
    const slides = [
        {
            src: '/storage/peta-persebaran.jpeg',
            description: 'Data pemantauan bulan Mei 2025. Ini menjadi acuan awal untuk program intervensi gizi.',
            month: 'Mei 2025',
        },
        {
            src: '/storage/peta-persebaran2.png',
            description: 'Memasuki bulan Juni, hasil intervensi mulai menunjukkan perubahan positif pada beberapa dusun prioritas.',
            month: 'Juni 2025',
        },
        {
            src: '/storage/peta-persebaran3.jpeg',
            description: 'Data terkini bulan Juli. Upaya bersama kita terus berlanjut untuk mewujudkan generasi bebas stunting.',
            month: 'Juli 2025',
        },
    ];
    const [currentIndex, setCurrentIndex] = useState(0);
    const goToNext = () => setCurrentIndex((prev) => (prev === slides.length - 1 ? 0 : prev + 1));
    const goToPrevious = () => setCurrentIndex((prev) => (prev === 0 ? slides.length - 1 : prev - 1));

    useEffect(() => {
        const slideInterval = setInterval(goToNext, 5000);
        return () => clearInterval(slideInterval);
    }, [currentIndex]);

    return (
        <div>
            <p className="mb-2 h-16 text-base text-gray-700 md:h-14">{slides[currentIndex].description}</p>
            <div className="relative aspect-[3/2] w-full">
                <div className="h-full w-full overflow-hidden rounded-lg shadow-lg">
                    <img
                        src={slides[currentIndex].src}
                        alt={`Peta Persebaran ${slides[currentIndex].month}`}
                        className="h-full w-full object-cover transition-all duration-300"
                        style={{ aspectRatio: '3/2' }}
                    />
                </div>
                <div className="absolute right-3 bottom-3 rounded-full bg-black/60 px-3 py-1 text-sm font-bold text-white backdrop-blur-sm">
                    {slides[currentIndex].month}
                </div>
                <button
                    onClick={goToPrevious}
                    className="absolute top-1/2 left-3 -translate-y-1/2 rounded-full bg-black/40 p-2 text-white hover:bg-black/70"
                    aria-label="Previous Slide"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button
                    onClick={goToNext}
                    className="absolute top-1/2 right-3 -translate-y-1/2 rounded-full bg-black/40 p-2 text-white hover:bg-black/70"
                    aria-label="Next Slide"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    );
};

const StatsCard: React.FC<{ stat: DusunStat; isInView: boolean }> = memo(({ stat, isInView }) => (
    <div className="flex flex-col items-center rounded-xl bg-white p-5 shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <h3 className="text-xl font-semibold text-gray-800">{stat.desa}</h3>
        <div className="mt-2 text-3xl font-extrabold text-blue-600">
            {isInView ? <CountUp start={0} end={stat.jumlah_anak} duration={2.2} separator="," /> : '0'}
        </div>
        <p className="mt-1 text-sm text-gray-600">Jumlah Anak Terindikasi Stunting</p>
    </div>
));

const ArtikelCard: React.FC<{ artikel: ArtikelPreview }> = ({ artikel }) => (
    <div className="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <img src={artikel.image} alt={artikel.title} className="h-40 w-full object-cover transition-transform group-hover:scale-110" />
        <div className="flex flex-grow flex-col p-4">
            <h3 className="mb-1 text-lg font-bold text-gray-800">{artikel.title}</h3>
            <p className="mb-2 line-clamp-3 flex-grow text-sm text-gray-600">{artikel.description}</p>
            <Link href={route('artikel.show', artikel.id)} className="mt-auto inline-block text-sm font-semibold text-blue-600 hover:underline">
                Baca Selengkapnya →
            </Link>
        </div>
    </div>
);

const Beranda: React.FC<{ dusunStats: DusunStat[]; artikels: ArtikelPreview[] }> = ({ dusunStats, artikels }) => {
    const [isInView, setIsInView] = useState(false);
    const statsSectionRef = useRef<HTMLDivElement | null>(null);
    const [open, setOpen] = useState(false);
    useEffect(() => {
        const observer = new window.IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    setIsInView(true);
                    observer.unobserve(entry.target);
                }
            },
            { threshold: 0.1 },
        );
        const currentRef = statsSectionRef.current;
        if (currentRef) observer.observe(currentRef);
        return () => {
            if (currentRef) observer.unobserve(currentRef);
        };
    }, []);

    const handleScrollToMap = () => {
        document.getElementById('peta-interaktif')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    return (
        <div
            className="flex min-h-screen flex-col bg-gray-50 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8"
            style={{ backgroundImage: "url('/storage/bg-test.png')" }}
        >
            <Head title="P3SA - Beranda" />
            {/* Navbar */}
            <nav className="sticky top-0 right-0 left-0 z-50 mx-auto mb-2 w-full max-w-5xl bg-white/80 shadow-md backdrop-blur-md md:rounded-full">
                {/* Padding vertikal diubah dari py-3 menjadi py-4 */}
                <div className="mx-auto flex w-full max-w-5xl items-center justify-between px-4 py-8 sm:px-6">
                    {/* Logo */}
                    <div className="flex items-center space-x-2">
                        <img src="/storage/logo.png" alt="PetaTumbuh Logo" className="h-9 w-9 rounded-full object-contain shadow" />
                        <h1 className="text-xl font-extrabold tracking-tight text-blue-600">P3SA</h1>
                    </div>
                    {/* Desktop Menu */}
                    <div className="hidden items-center space-x-8 font-semibold text-gray-600 md:flex">
                        <Link href={route('home')} className="transition-colors hover:text-blue-600 hover:underline">
                            Beranda
                        </Link>
                        <Link href={route('artikel.index')} className="transition-colors hover:text-blue-600 hover:underline">
                            Artikel
                        </Link>
                        <Link href={route('ebook')} className="transition-colors hover:text-blue-600 hover:underline">
                            E-Book
                        </Link>
                    </div>
                    {/* Mobile Hamburger */}
                    <button className="p-2 focus:outline-none md:hidden" onClick={() => setOpen(!open)} aria-label="Menu">
                        {open ? <X size={28} /> : <Menu size={28} />}
                    </button>
                </div>
                {/* Mobile Dropdown */}
                <div
                    className={`absolute top-full left-0 w-full bg-white/95 shadow-md transition-all duration-200 md:hidden md:rounded-b-2xl ${open ? 'block' : 'hidden'}`}
                >
                    <div className="flex flex-col items-center gap-2 py-3 text-base font-semibold text-gray-700">
                        <Link href={route('home')} className="w-full py-1 text-center hover:text-blue-600" onClick={() => setOpen(false)}>
                            Beranda
                        </Link>
                        <Link href={route('artikel.index')} className="w-full py-1 text-center hover:text-blue-600" onClick={() => setOpen(false)}>
                            Artikel
                        </Link>
                        <Link href={route('ebook')} className="w-full py-1 text-center hover:text-blue-600" onClick={() => setOpen(false)}>
                            E-Book
                        </Link>
                    </div>
                </div>
            </nav>

            {/* Main Section */}
            <main className="mt-4 sm:mt-8">
                <div
                    className="relative mb-10 flex min-h-[320px] w-full items-center justify-center overflow-hidden rounded-xl bg-cover bg-center shadow-xl sm:min-h-[420px] lg:min-h-[65vh]"
                    style={{ backgroundImage: `url('/storage/dipakelagi.jpg')` }}
                >
                    <div className="absolute inset-0 z-10 bg-gradient-to-t from-black/70 via-black/40 to-transparent" />
                    <div className="animate-fade-in relative z-20 px-3 text-center sm:px-4">
                        <div className="mx-auto max-w-2xl rounded-3xl bg-white/90 p-6 shadow-2xl backdrop-blur-xs sm:max-w-3xl sm:p-10">
                            <h1 className="text-2xl leading-tight font-extrabold tracking-tight text-gray-800 sm:text-4xl md:text-5xl">
                                <span className="bg-gradient-to-r from-blue-700 via-sky-500 to-cyan-400 bg-clip-text text-transparent">
                                    Pemantauan Stunting Anak
                                </span>{' '}
                                Melalui Peta Interaktif
                            </h1>
                            <p className="mt-3 text-base text-gray-700 sm:mt-4 sm:text-lg">
                                Sistem ini membantu masyarakat Desa Kalangdosari dan tenaga kesehatan dalam pencegahan stunting dengan informasi
                                akurat dan akses mudah.
                            </p>
                            <div className="mt-6 flex flex-col justify-center gap-3 sm:mt-8 sm:flex-row sm:gap-4">
                                <button
                                    type="button"
                                    onClick={handleScrollToMap}
                                    className="rounded-md bg-blue-600 px-8 py-3 font-semibold text-white shadow-lg transition-transform hover:scale-105"
                                >
                                    Lihat Peta Persebaran
                                </button>
                                <button
                                    type="button"
                                    onClick={() => (window.location.href = route('ebook'))}
                                    className="rounded-md border border-blue-500 bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all hover:scale-105 hover:bg-blue-50"
                                >
                                    Akses E-Book Edukasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div ref={statsSectionRef} className="mb-10">
                    <h2 className="mb-7 text-center text-2xl font-bold text-gray-800 sm:text-3xl">Statistik Stunting per Dusun</h2>
                    <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        {dusunStats.map((stat) => (
                            <StatsCard key={stat.desa} stat={stat} isInView={isInView} />
                        ))}
                    </div>
                </div>
                <div id="peta-interaktif" className="mb-10 flex flex-col gap-8 md:flex-row">
                    <div className="w-full rounded-xl bg-white p-5 shadow-xl md:w-1/2">
                        <h2 className="mb-4 text-2xl font-bold text-gray-800 sm:text-3xl">Apa Itu Stunting?</h2>
                        <p className="text-justify text-base leading-relaxed text-gray-700">
                            Stunting adalah masalah kurang gizi kronis yang disebabkan oleh asupan gizi yang kurang dalam waktu cukup lama. Kondisi
                            ini tidak hanya menyebabkan hambatan pertumbuhan fisik, tetapi juga mengancam perkembangan kognitif yang akan berpengaruh
                            pada tingkat kecerdasan dan produktivitas anak di masa depan. Pemantauan dini sangat penting untuk pencegahan.
                        </p>
                    </div>
                    <div className="w-full rounded-xl bg-white p-5 shadow-xl md:w-1/2">
                        <h2 className="mb-4 text-2xl font-bold text-gray-800 sm:text-3xl">Perkembangan Data Stunting</h2>
                        <SlideshowWithDescription />
                    </div>
                </div>
                {/* === SECTION ARTIKEL BARU === */}
                <div className="mb-8">
                    <div className="mb-6 text-center">
                        <h2 className="text-2xl font-bold text-gray-800 sm:text-3xl">Artikel & Informasi Terbaru</h2>
                        <p className="mt-2 text-base text-gray-600 sm:text-lg">Baca informasi terkini seputar gizi dan pencegahan stunting.</p>
                    </div>
                    <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        {artikels.map((artikel) => (
                            <ArtikelCard key={artikel.id} artikel={artikel} />
                        ))}
                    </div>
                </div>
            </main>
            <footer className="mt-auto border-t bg-white px-4 pt-8 pb-4 text-center text-sm text-gray-500">
                <div className="mx-auto flex max-w-3xl flex-col items-center gap-2">
                    <img src="/storage/logo.png" alt="Logo P3SA" className="mb-1 h-9 w-9 object-contain" />
                    <div className="font-semibold text-gray-700">P3SA Kalangdosari</div>
                    <div className="mb-2 text-xs text-gray-400">Portal Pencegahan & Penanganan Stunting Anak</div>
                    <div className="flex justify-center gap-4 text-xs">
                        <a href={route('home')} className="transition hover:text-blue-500">
                            Beranda
                        </a>
                        <a href={route('artikel.index')} className="transition hover:text-blue-500">
                            Artikel
                        </a>
                        <a href={route('ebook')} className="transition hover:text-blue-500">
                            E-Book
                        </a>
                    </div>
                    <p className="mt-3 text-xs text-gray-400">&copy; 2025 P3SA Kalangdosari. Hak Cipta Dilindungi.</p>
                </div>
            </footer>
        </div>
    );
};

export default Beranda;
