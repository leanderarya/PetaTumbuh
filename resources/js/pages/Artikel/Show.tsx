'use client';

import { Head, Link } from '@inertiajs/react';
import { Menu, X } from 'lucide-react';
import React, { useState } from 'react';

// --- Type Definitions ---
type ArtikelDetail = {
    id: number;
    title: string;
    image: string;
    date: string;
    author: string;
    content: string;
};

type OtherArtikel = {
    id: number;
    title: string;
    image: string;
};

// --- Fungsi Helper ---
const formatDate = (dateString: string) => {
    const options: Intl.DateTimeFormatOptions = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

// =================================================================================
// KOMPONEN KARTU ARTIKEL LAINNYA
// =================================================================================
const OtherArtikelCard: React.FC<{ artikel: OtherArtikel }> = ({ artikel }) => (
    <Link href={route('artikel.show', artikel.id)} className="group block">
        <div className="flex items-center space-x-4 rounded-lg bg-gray-50 p-3 transition duration-300 hover:bg-gray-100 hover:shadow-sm">
            <img src={artikel.image} alt={artikel.title} className="h-16 w-16 flex-shrink-0 rounded-md object-cover" />
            <div className="flex-grow">
                <h3 className="text-base font-semibold text-gray-800 group-hover:text-blue-600">{artikel.title}</h3>
            </div>
        </div>
    </Link>
);

// =================================================================================
// KOMPONEN UTAMA HALAMAN DETAIL ARTIKEL
// =================================================================================
export default function ArtikelShowPage({ artikel, otherArticles }: { artikel: ArtikelDetail; otherArticles: OtherArtikel[] }) {
    const [open, setOpen] = useState(false);

    return (
        <div
            className="flex min-h-screen flex-col bg-gray-50 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8"
            style={{ backgroundImage: "url('/storage/bg-test.png')" }}
        >
            <Head title={'P2SA - ' + artikel.title} />

            {/* Navbar */}
            <nav className="sticky top-0 right-0 left-0 z-50 mx-auto mb-2 w-full max-w-5xl rounded-full bg-white/80 px-8 py-4 shadow-md backdrop-blur-md">
                <div className="mx-auto flex w-full max-w-5xl items-center justify-between px-2 sm:px-4">
                    {/* Logo */}
                    <div className="flex items-center space-x-2">
                        <img src="/storage/logo.png" alt="PetaTumbuh Logo" className="h-9 w-9 rounded-full object-contain shadow" />
                        {/* === PERBAIKAN SAFARI 1: Logo menggunakan warna solid === */}
                        <h1 className="text-xl font-extrabold tracking-tight text-blue-600">P2SA</h1>
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
                    className={`absolute top-full left-0 w-full rounded-b-2xl bg-white/95 shadow-md transition-all duration-200 md:hidden ${open ? 'block' : 'hidden'}`}
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
                <article>
                    {/* Header Artikel dengan Gambar Utama */}
                    <header className="relative z-10 mx-auto max-w-5xl">
                        <div
                            className="h-[50vh] w-full rounded-2xl bg-cover bg-center shadow-2xl"
                            style={{ backgroundImage: `url(${artikel.image})` }}
                        />
                        <div className="absolute inset-0 z-10 rounded-2xl bg-gradient-to-t from-black/70 via-black/20 to-transparent" />
                        <div className="absolute bottom-0 z-20 p-8 text-white md:p-12">
                            <h1 className="text-4xl font-extrabold tracking-tight drop-shadow-lg md:text-5xl">{artikel.title}</h1>
                            <p className="mt-3 text-lg opacity-90 drop-shadow-md">
                                Oleh {artikel.author} • {formatDate(artikel.date)}
                            </p>
                        </div>
                    </header>

                    {/* Kartu Konten Putih */}
                    <div className="relative z-30 mx-auto -mt-8 max-w-5xl rounded-t-2xl bg-white p-8 shadow-2xl md:p-12">
                        {/* Wrapper untuk isi konten */}
                        {/* === PERBAIKAN SAFARI 2: Menambahkan warna teks eksplisit di sini === */}
                        <div className="mx-auto max-w-3xl text-gray-800">
                            {/* Styling tipografi otomatis dari @tailwindcss/typography */}
                            <div
                                className="prose prose-lg prose-indigo prose-p:leading-relaxed prose-a:text-blue-600 hover:prose-a:text-blue-500 max-w-none"
                                dangerouslySetInnerHTML={{ __html: artikel.content }}
                            />

                            <hr className="my-16 border-t border-gray-200" />

                            <section>
                                <h2 className="mb-6 text-2xl font-bold text-gray-800">Baca Juga Artikel Lainnya</h2>
                                <div className="space-y-4">
                                    {otherArticles.map((other) => (
                                        <OtherArtikelCard key={other.id} artikel={other} />
                                    ))}
                                </div>
                            </section>

                            <div className="mt-16 text-center">
                                <Link
                                    href={route('artikel.index')}
                                    className="inline-block rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition-all duration-300 hover:scale-105 hover:bg-blue-700"
                                >
                                    ← Kembali ke Daftar Artikel
                                </Link>
                            </div>
                        </div>
                    </div>
                </article>
            </main>

            <footer className="mt-8 border-t bg-white px-4 pt-8 pb-4 text-center text-sm text-gray-500">
                <div className="mx-auto flex max-w-3xl flex-col items-center gap-2">
                    <img src="/storage/logo.png" alt="Logo P3SA" className="mb-1 h-9 w-9 object-contain" />
                    <div className="font-semibold text-gray-700">P2SA Kalangdosari</div>
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
                    <p className="mt-3 text-xs text-gray-400">&copy; 2025 P2SA Kalangdosari. Hak Cipta Dilindungi.</p>
                </div>
            </footer>
        </div>
    );
}
