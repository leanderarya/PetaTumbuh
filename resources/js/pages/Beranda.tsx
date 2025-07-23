'use client';

import { Head, Link } from '@inertiajs/react';
import { Heart, Menu, X } from 'lucide-react';
import React, { memo, useEffect, useRef, useState } from 'react';
import CountUp from 'react-countup';

type DusunStat = { desa: string; jumlah_anak: number };
type ArtikelPreview = { id: number; title: string; description: string; image: string; date: string };

const SlideshowWithDescription: React.FC = () => {
    const slides = [
        {
            src: '/storage/peta-persebaran.png', // Ganti dengan path gambar Anda, misal: '/storage/gambar-4135x5849.jpg'
            description: 'Data pemantauan bulan April 2025.',
            month: 'April 2025',
        },
        {
            src: '/storage/peta-persebaran2.png',
            description: 'Data pemantauan bulan Mei 2025.',
            month: 'Mei 2025',
        },
        {
            src: '/storage/peta-persebaran3.png',
            description: 'Data pemantauan bulan Juni 2025.',
            month: 'Juni 2025',
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
            {/* Container diubah agar tidak ada aspect-ratio tetap */}
            <div className="relative w-full">
                {/* Struktur gambar disederhanakan.
                  - `w-full` membuat lebar gambar penuh.
                  - `h-auto` membuat tinggi gambar menyesuaikan secara otomatis sesuai aspek rasio aslinya.
                  - `object-contain` memastikan seluruh bagian gambar terlihat.
                  - `rounded-lg shadow-lg` dipindahkan langsung ke gambar.
                  - style inline `aspectRatio` dihapus.
                */}
                <img
                    src={slides[currentIndex].src}
                    alt={`Peta Persebaran ${slides[currentIndex].month}`}
                    className="h-auto w-full rounded-lg object-contain shadow-lg transition-all duration-300"
                />
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
        <div className="mt-2 font-sans text-3xl font-extrabold text-black">
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
                    className="relative mb-10 flex w-full items-center justify-center overflow-hidden rounded-xl bg-cover bg-center shadow-xl sm:min-h-[420px] lg:min-h-[65vh]"
                    style={{ backgroundImage: `url('/storage/dipakelagi.jpg')` }}
                >
                    <div className="absolute inset-0 z-10 bg-gradient-to-t from-black/70 via-black/40 to-transparent" />
                    <div className="animate-fade-in relative z-20 px-4 text-center sm:px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl rounded-3xl bg-white/90 p-6 shadow-2xl backdrop-blur-xs sm:max-w-3xl sm:p-10 lg:max-w-4xl lg:p-12">
                            <h1 className="text-2xl leading-tight font-extrabold tracking-tight text-gray-800 sm:text-3xl md:text-4xl lg:text-5xl">
                                <span className="bg-gradient-to-r from-blue-700 via-sky-500 to-cyan-400 bg-clip-text text-transparent">
                                    Pemantauan Stunting Anak
                                </span>{' '}
                                Melalui Pemetaan Akurat dan Sumber Daya Edukatif
                            </h1>
                            <p className="mt-3 text-base text-gray-700 sm:mt-4 sm:text-base md:text-xl lg:text-xl">
                                Dapatkan informasi terbaru tentang stunting melalui pemetaan interaktif serta akses ke artikel dan e-book yang
                                bermanfaat untuk pencegahan stunting di Desa Kalangdosari.
                            </p>
                            <div className="mx-auto mt-6 flex flex-col justify-center gap-3 sm:mt-8 sm:flex-row sm:gap-4 lg:gap-6">
                                <button
                                    type="button"
                                    onClick={handleScrollToMap}
                                    className="rounded-md bg-blue-600 px-8 py-3 font-semibold text-white shadow-lg transition-transform hover:scale-105 sm:px-6 md:px-8 lg:px-10"
                                >
                                    Lihat Peta Persebaran
                                </button>
                                <button
                                    type="button"
                                    onClick={() => (window.location.href = route('ebook'))}
                                    className="rounded-md border border-blue-500 bg-white px-8 py-3 font-semibold text-blue-600 shadow-lg transition-all hover:scale-105 hover:bg-blue-50 sm:px-6 md:px-8 lg:px-10"
                                >
                                    Akses E-Book Edukasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div ref={statsSectionRef} className="mb-10">
                    <h2 className="mb-7 text-center text-2xl font-bold text-gray-800 sm:text-3xl">Statistik Stunting per Dusun</h2>
                    <div className="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        {dusunStats.map((stat) => (
                            <StatsCard key={stat.desa} stat={stat} isInView={isInView} />
                        ))}
                    </div>
                </div>
                {/* Info dan Peta Section */}
                <div id="peta-interaktif" className="mb-10 flex flex-col gap-10 md:flex-row md:items-start">
                    {/* Kolom Kiri: Penjelasan */}
                    {/* Ganti seluruh konten div ini dengan kode di bawah */}
                    <div className="w-full rounded-xl bg-white p-6 shadow-lg md:w-1/2">
                        <h2 className="mb-5 text-3xl leading-tight font-extrabold text-gray-800 sm:text-4xl">
                            Mengenal Stunting, Melindungi Masa Depan
                        </h2>
                        <p className="mb-6 text-justify text-lg leading-relaxed font-medium text-gray-700">
                            Stunting bukan sekadar masalah tinggi badan. Ini adalah kondisi gagal tumbuh akibat kekurangan gizi kronis yang dapat
                            menghambat perkembangan otak dan fisik anak secara permanen. Dampaknya tidak hanya terasa saat ini, tetapi juga
                            memengaruhi kecerdasan dan produktivitas mereka di masa depan.
                        </p>

                        {/* === KONTEN TAMBAHAN 1 === */}
                        <h4 className="mt-8 mb-3 text-xl font-bold text-gray-800">Pentingnya 1000 Hari Pertama Kehidupan (HPK)</h4>
                        <p className="text-justify text-lg leading-relaxed font-medium text-gray-700">
                            Periode emas dari masa kehamilan hingga anak berusia dua tahun adalah jendela kritis. Kekurangan gizi pada masa ini dapat
                            menyebabkan kerusakan yang sulit diperbaiki. Oleh karena itu, intervensi dan pemantauan dini melalui platform seperti ini
                            menjadi kunci utama keberhasilan kita.
                        </p>
                        {/* ======================= */}

                        <h3 className="mt-8 mb-4 text-2xl leading-tight font-semibold text-gray-800 sm:text-3xl">
                            Misi Kita Bersama di Kalangdosari
                        </h3>
                        <p className="mb-6 text-justify text-lg leading-relaxed font-medium text-gray-700">
                            Melalui platform ini, kita memetakan kondisi gizi di setiap dusun secara akurat. Data ini bukanlah sekadar angka,
                            melainkan panduan bagi kita untuk mengambil tindakan yang cepat dan tepat sasaran. Dengan pemantauan rutin dan akses ke
                            sumber edukasi, kita berdaya untuk memastikan setiap anak mendapatkan awal terbaik dalam hidupnya dan tumbuh menjadi
                            generasi yang sehat dan cerdas.
                        </p>

                        {/* === KONTEN TAMBAHAN 2 === */}
                        <h4 className="mt-8 mb-4 text-xl font-bold text-gray-800">Bagaimana Anda Dapat Berperan?</h4>
                        <ul className="list-disc space-y-2 pl-5 text-lg font-medium text-gray-700">
                            <li>
                                <b>Pantau Rutin:</b> Pastikan anak Anda mendapatkan pemantauan pertumbuhan dan perkembangan secara berkala di
                                Posyandu.
                            </li>
                            <li>
                                <b>Edukasi Diri:</b> Manfaatkan artikel dan e-book yang kami sediakan untuk menambah wawasan mengenai gizi seimbang
                                dan pola asuh yang tepat.
                            </li>
                            <li>
                                <b>Aksi Nyata:</b> Terapkan pengetahuan yang didapat dalam kehidupan sehari-hari untuk mendukung tumbuh kembang
                                optimal anak.
                            </li>
                        </ul>
                        {/* ======================= */}
                    </div>

                    {/* Kolom Kanan: Slideshow Peta */}
                    <div className="w-full rounded-xl bg-white p-6 shadow-lg md:w-1/2">
                        <h2 className="mb-5 text-3xl leading-tight font-extrabold text-gray-800 sm:text-4xl">Perkembangan Data Stunting</h2>
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
                    <p className="mt-3 text-xs text-gray-400">&copy; 2025 P3SA Kalangdosari. Hak Cipta Dilindungi.</p>

                    {/* Add Made with Love text with heart icon */}
                    <div className="mt-4 flex items-center justify-center text-xs text-gray-500">
                        <span className="mr-2">Made with</span>
                        <Heart className="text-red-500" />
                        <span className="ml-2">by KKN-T 116 Universitas Diponegoro</span>
                    </div>
                </div>
            </footer>
        </div>
    );
};

export default Beranda;
