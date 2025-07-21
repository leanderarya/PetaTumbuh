'use client';

import { Head, Link } from '@inertiajs/react';
import { Menu, X } from 'lucide-react';
import React, { useMemo, useState } from 'react';

// --- Type Definition ---
type Ebook = {
    id: number;
    title: string;
    description: string;
    image: string; // Diasumsikan sudah berisi URL lengkap
    file: string; // Diasumsikan sudah berisi URL lengkap
    is_new: boolean;
};

// =================================================================================
// KOMPONEN KARTU E-BOOK (REUSABLE)
// =================================================================================
interface EbookCardProps {
    ebook: Ebook;
}

const EbookCard: React.FC<EbookCardProps> = ({ ebook }) => {
    return (
        <div className="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div className="relative">
                {/* MENGGUNAKAN LINK LAMA (LANGSUNG DARI PROPS) */}
                <img
                    src={ebook.image}
                    alt={ebook.title}
                    className="h-64 w-full object-cover transition-transform duration-300 group-hover:scale-110"
                />
                {ebook.is_new && (
                    <span className="absolute top-3 right-3 rounded-full bg-gradient-to-r from-pink-500 to-red-400 px-3 py-1 text-xs font-bold text-white shadow-md">
                        BARU
                    </span>
                )}
            </div>
            <div className="flex flex-grow flex-col p-6">
                <h2 className="mb-2 text-xl font-bold text-gray-800">{ebook.title}</h2>
                <p className="mb-4 line-clamp-3 flex-grow text-sm text-gray-600">{ebook.description}</p>
                {/* MENGGUNAKAN LINK LAMA (LANGSUNG DARI PROPS) */}
                <a
                    href={ebook.file}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="mt-auto inline-block w-full rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-3 text-center text-sm font-semibold text-white shadow-md transition-all duration-300 hover:from-blue-600 hover:to-cyan-600"
                >
                    📥 Unduh E-Book
                </a>
            </div>
        </div>
    );
};

// =================================================================================
// KOMPONEN UTAMA HALAMAN E-BOOK
// =================================================================================
export default function EbookPage({ ebooks }: { ebooks: Ebook[] }) {
    const [searchQuery, setSearchQuery] = useState('');
    const [open, setOpen] = useState(false);

    const filteredEbooks = useMemo(() => {
        if (!searchQuery) {
            return ebooks;
        }
        return ebooks.filter(
            (ebook) =>
                ebook.title.toLowerCase().includes(searchQuery.toLowerCase()) || ebook.description.toLowerCase().includes(searchQuery.toLowerCase()),
        );
    }, [searchQuery, ebooks]);

    return (
        <div
            className="flex min-h-screen flex-col bg-gray-50 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8"
            style={{ backgroundImage: "url('/storage/bg-test.png')" }}
        >
            <Head title="P3SA - Katalog E-Book Pencegahan Stunting" />

            {/* Navbar */}
            <nav className="sticky top-0 right-0 left-0 z-50 mx-auto mb-2 w-full max-w-5xl rounded-full bg-white/80 px-8 py-8 shadow-md backdrop-blur-md">
                <div className="mx-auto flex w-full max-w-5xl items-center justify-between px-2 sm:px-4">
                    {/* Logo */}
                    <div className="flex items-center space-x-2">
                        <img src="/storage/logo.png" alt="PetaTumbuh Logo" className="h-9 w-9 rounded-full object-contain shadow" />
                        <h1 className="text-xl font-extrabold tracking-tight text-gray-800">
                            <span className="bg-gradient-to-r from-blue-600 to-cyan-400 bg-clip-text text-transparent">P3SA</span>
                        </h1>
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
                <div className="mb-8 text-center">
                    <h1 className="mb-2 text-4xl font-extrabold tracking-tight text-gray-800">📚 Katalog E-Book Pencegahan Stunting</h1>
                    <p className="text-lg text-gray-600">Temukan panduan edukatif untuk cegah stunting sejak dini.</p>
                </div>

                <section className="mb-12">
                    <div className="mx-auto max-w-3xl px-4">
                        <div className="relative">
                            <input
                                type="text"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full rounded-full border border-gray-300 bg-white px-6 py-4 pr-14 text-base shadow-sm transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Cari e-book berdasarkan judul atau deskripsi..."
                            />
                            <div className="absolute top-1/2 right-5 -translate-y-1/2 text-gray-400">🔍</div>
                        </div>
                    </div>
                </section>

                <div className="mx-auto grid max-w-7xl grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                    {filteredEbooks.length > 0 ? (
                        filteredEbooks.map((ebook) => <EbookCard key={ebook.id} ebook={ebook} />)
                    ) : (
                        <div className="col-span-full mt-8 text-center">
                            <p className="text-xl text-gray-500">🔎 E-book yang Anda cari tidak ditemukan.</p>
                        </div>
                    )}
                </div>
            </main>

            <footer className="mt-8 border-t bg-white px-4 pt-8 pb-4 text-center text-sm text-gray-500">
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
}
