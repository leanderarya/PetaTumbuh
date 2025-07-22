'use client';

import { Head, Link } from '@inertiajs/react';
import { Heart, Menu, X } from 'lucide-react';
import React, { useMemo, useState } from 'react';

// Tipe data ini sekarang cocok dengan yang dikirim controller
type Artikel = {
    id: number;
    title: string;
    description: string;
    image: string; // Ini sudah URL lengkap dari backend
    date: string;
    is_new: boolean;
};

// Fungsi helper untuk format tanggal
const formatDate = (dateString: string) => {
    const options: Intl.DateTimeFormatOptions = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

const ArtikelCard: React.FC<{ artikel: Artikel }> = ({ artikel }) => (
    <div className="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
        <div className="relative">
            <img
                src={artikel.image}
                alt={artikel.title}
                className="h-56 w-full object-cover transition-transform duration-300 group-hover:scale-110"
            />
            {artikel.is_new && (
                <span className="absolute top-3 right-3 rounded-full bg-gradient-to-r from-pink-500 to-red-400 px-3 py-1 text-xs font-bold text-white shadow-md">
                    BARU
                </span>
            )}
        </div>
        <div className="flex flex-grow flex-col p-6">
            <h2 className="mb-2 text-xl font-bold text-gray-800">{artikel.title}</h2>
            <p className="mb-4 line-clamp-3 flex-grow text-sm text-gray-600">{artikel.description}</p>
            <span className="mb-4 text-xs text-gray-500">Diterbitkan: {formatDate(artikel.date)}</span>
            {/* Menggunakan route 'artikel.show' dengan parameter ID */}
            <Link
                href={route('artikel.show', artikel.id)}
                className="mt-auto inline-block w-full rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-3 text-center text-sm font-semibold text-white shadow-md transition-all duration-300 hover:from-blue-600 hover:to-cyan-600"
            >
                Baca Selengkapnya
            </Link>
        </div>
    </div>
);

export default function ArtikelIndexPage({ artikels }: { artikels: Artikel[] }) {
    const [search, setSearch] = useState('');
    const [open, setOpen] = useState(false);

    // --- State dan Logika Paginasi ---
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 6; // Menampilkan 6 artikel per halaman

    // Proses filter sekarang menggunakan data dari props 'artikels'
    const filteredArtikel = useMemo(() => {
        setCurrentPage(1); // Reset ke halaman 1 setiap kali ada pencarian baru
        if (!search) {
            return artikels;
        }
        return artikels.filter((artikel) => artikel.title.toLowerCase().includes(search.toLowerCase()));
    }, [search, artikels]);

    const totalPages = Math.ceil(filteredArtikel.length / itemsPerPage);
    const paginatedData = filteredArtikel.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);

    return (
        <div
            className="flex min-h-screen flex-col bg-gray-50 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8"
            style={{ backgroundImage: "url('/storage/bg-test.png')" }}
        >
            <Head title="P3SA - Katalog Artikel" />
            {/* Navbar */}
            <nav className="sticky top-0 right-0 left-0 z-50 mx-auto mb-2 w-full max-w-5xl bg-white/80 shadow-md backdrop-blur-md md:rounded-full">
                <div className="mx-auto flex w-full max-w-5xl items-center justify-between px-4 py-8 sm:px-6">
                    <div className="flex items-center space-x-2">
                        <img src="/storage/logo.png" alt="PetaTumbuh Logo" className="h-9 w-9 rounded-full object-contain shadow" />
                        <h1 className="text-xl font-extrabold tracking-tight text-blue-600">P3SA</h1>
                    </div>
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
                    <button className="p-2 focus:outline-none md:hidden" onClick={() => setOpen(!open)} aria-label="Menu">
                        {open ? <X size={28} /> : <Menu size={28} />}
                    </button>
                </div>
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

            <main className="mt-4">
                <header className="mb-12 text-center">
                    <h1 className="mb-2 text-4xl font-extrabold tracking-tight text-gray-800">📰 Katalog Artikel Pencegahan Stunting</h1>
                    <p className="text-lg text-gray-600">Temukan artikel-artikel edukatif untuk cegah stunting sejak dini.</p>
                </header>

                <section className="mb-12">
                    <div className="relative mx-auto max-w-3xl px-4">
                        <input
                            type="search"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                            className="w-full rounded-full border border-gray-300 bg-white px-6 py-4 pr-14 text-base shadow-sm transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                            placeholder="Cari artikel berdasarkan judul..."
                        />
                        <div className="pointer-events-none absolute top-1/2 right-8 -translate-y-1/2 text-xl text-gray-400">🔍</div>
                    </div>
                </section>

                <section>
                    <div className="mx-auto grid max-w-7xl grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        {paginatedData.length > 0 ? (
                            paginatedData.map((artikel) => <ArtikelCard key={artikel.id} artikel={artikel} />)
                        ) : (
                            <div className="col-span-full mt-8 text-center">
                                <p className="text-xl text-gray-500">🔎 Artikel yang Anda cari tidak ditemukan.</p>
                            </div>
                        )}
                    </div>
                </section>

                {/* === BAGIAN PAGINATION BARU === */}
                {totalPages > 1 && (
                    <div className="mt-12 flex flex-col items-center justify-between gap-4 rounded-xl border bg-white/80 p-4 shadow-md md:flex-row">
                        <span className="text-sm font-semibold text-gray-600">
                            Halaman {currentPage} dari {totalPages}
                        </span>
                        <div className="inline-flex items-center -space-x-px">
                            <button
                                onClick={() => setCurrentPage((p) => Math.max(p - 1, 1))}
                                disabled={currentPage === 1}
                                className="rounded-l-md border bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                Sebelumnya
                            </button>
                            <button
                                onClick={() => setCurrentPage((p) => Math.min(p + 1, totalPages))}
                                disabled={currentPage === totalPages}
                                className="rounded-r-md border bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                )}
            </main>

            <footer className="mt-8 border-t bg-white px-4 pt-8 pb-4 text-center text-sm text-gray-500">
                <div className="mx-auto flex max-w-3xl flex-col items-center gap-2">
                    <img src="/storage/logo.png" alt="Logo P3SA" className="mb-1 h-9 w-9 object-contain" />
                    <div className="font-semibold text-gray-700">P3SA Kalangdosari</div>
                    <div className="mb-2 text-xs text-gray-400">Portal Pencegahan & Penanganan Stunting Anak</div>
                    <p className="mt-3 text-xs text-gray-400">&copy; 2025 P3SA Kalangdosari. Hak Cipta Dilindungi.</p>
                    <div className="mt-4 flex items-center justify-center text-xs text-gray-500">
                        <span className="mr-2">Made with</span>
                        <Heart className="text-red-500" />
                        <span className="ml-2">by KKN-T 116 Universitas Diponegoro</span>
                    </div>
                </div>
            </footer>
        </div>
    );
}
