'use client';

import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import { FormEvent, useEffect, useState } from 'react';
import Swal from 'sweetalert2';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Manajemen E-Book', href: '/upload-ebook' },
];

type Ebook = {
    id: number;
    title: string;
    description: string;
    is_new: boolean;
    image: string; // URL gambar cover
    file: string; // URL file PDF
};

type EditingEbook = {
    id: number;
    title: string;
    description: string;
    is_new: boolean;
    cover_preview: string;
};

type Props = {
    editingEbook?: EditingEbook;
    ebooks: Ebook[];
};

export default function FormEbook({ editingEbook, ebooks }: Props) {
    const [selectedEbookId, setSelectedEbookId] = useState<number | null>(editingEbook?.id ?? null);

    const { data, setData, post, processing, errors, reset } = useForm<{
        title: string;
        description: string;
        file: File | null;
        cover: File | null;
        is_new: boolean;
    }>({
        title: editingEbook?.title || '',
        description: editingEbook?.description || '',
        file: null,
        cover: null,
        is_new: editingEbook?.is_new ?? true,
    });

    const [coverPreview, setCoverPreview] = useState<string | null>(editingEbook?.cover_preview || null);

    useEffect(() => {
        if (data.cover) {
            const reader = new FileReader();
            reader.onloadend = () => setCoverPreview(reader.result as string);
            reader.readAsDataURL(data.cover);
        } else if (editingEbook?.cover_preview) {
            setCoverPreview(editingEbook.cover_preview);
        } else {
            setCoverPreview(null);
        }
        // eslint-disable-next-line
    }, [data.cover]);

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();

        if (!data.title.trim() || !data.description.trim()) {
            Swal.fire('Form tidak lengkap', 'Harap lengkapi judul dan deskripsi.', 'warning');
            return;
        }

        const formData = new FormData();
        formData.append('title', data.title);
        formData.append('description', data.description);
        formData.append('is_new', data.is_new ? '1' : '0');

        if (data.file) formData.append('file', data.file);
        if (data.cover) formData.append('cover', data.cover);

        if (selectedEbookId) {
            // PATCH/PUT dengan FormData harus lewat POST + _method=PUT
            formData.append('_method', 'PUT');
            router.post(`/ebooks/${selectedEbookId}`, formData, {
                forceFormData: true,
                onSuccess: () => {
                    Swal.fire('Berhasil!', 'E-Book berhasil diperbarui.', 'success');
                    reset();
                    setCoverPreview(null);
                    setSelectedEbookId(null);
                },
            });
        } else {
            post(route('ebooks.store'), {
                forceFormData: true,
                onSuccess: () => {
                    Swal.fire('Berhasil!', 'E-Book berhasil diunggah!', 'success');
                    reset();
                    setCoverPreview(null);
                },
            });
        }
    };

    const handleDeleteEbook = (id: number) => {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data e-book yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(`/ebooks/${id}`, {
                    onSuccess: () => {
                        Swal.fire('Berhasil!', 'E-Book telah dihapus.', 'success');
                    },
                });
            }
        });
    };

    const handleEditEbook = (ebook: Ebook) => {
        setData({
            title: ebook.title,
            description: ebook.description,
            file: null,
            cover: null,
            is_new: ebook.is_new,
        });
        setCoverPreview(ebook.image);
        setSelectedEbookId(ebook.id);
        Swal.fire('Mode Edit', 'Silakan ubah data lalu klik simpan.', 'info');
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Upload E-Book Edukasi" />
            <div className="mx-auto w-full max-w-4xl rounded-2xl bg-white p-4 shadow-lg sm:p-8">
                <h1 className="mb-6 text-xl font-bold text-blue-800 sm:text-2xl">📘 Upload E-Book Edukasi Gizi & Stunting</h1>

                {/* --- FORM UPLOAD --- */}
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div>
                        <label className="mb-1 block text-sm font-semibold text-gray-700">
                            Judul E-Book <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Contoh: Panduan Gizi Anak 2025"
                            className="w-full rounded-md border border-gray-300 px-4 py-2 text-base focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            value={data.title}
                            onChange={(e) => setData('title', e.target.value)}
                            autoComplete="off"
                        />
                        {errors.title && <p className="mt-1 text-sm text-red-600">{errors.title}</p>}
                    </div>
                    <div>
                        <label className="mb-1 block text-sm font-semibold text-gray-700">
                            Deskripsi Singkat <span className="text-red-500">*</span>
                        </label>
                        <textarea
                            placeholder="Tuliskan ringkasan isi e-book, misal: Berisi edukasi gizi pada 1000 HPK untuk cegah stunting."
                            className="w-full rounded-md border border-gray-300 px-4 py-2 text-base focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            rows={4}
                            value={data.description}
                            onChange={(e) => setData('description', e.target.value)}
                        />
                        {errors.description && <p className="mt-1 text-sm text-red-600">{errors.description}</p>}
                    </div>
                    <div>
                        <label className="mb-1 block text-sm font-semibold text-gray-700">
                            File E-Book (PDF) <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="file"
                            accept="application/pdf"
                            className="block w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-base file:mr-4 file:rounded-lg file:border-0 file:bg-blue-100 file:px-4 file:py-2 file:font-semibold file:text-blue-700 hover:file:bg-blue-200"
                            onChange={(e) => setData('file', e.target.files?.[0] || null)}
                            aria-label="Upload file PDF e-book"
                        />
                        <p className="mt-1 text-xs text-gray-500">Format: PDF, maksimal 5MB</p>
                        {errors.file && <p className="mt-1 text-sm text-red-600">{errors.file}</p>}
                    </div>
                    <div>
                        <label className="mb-1 block text-sm font-semibold text-gray-700">Cover E-Book (JPG/PNG)</label>
                        <input
                            type="file"
                            accept="image/*"
                            className="block w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-base file:mr-4 file:rounded-lg file:border-0 file:bg-cyan-100 file:px-4 file:py-2 file:font-semibold file:text-cyan-700 hover:file:bg-cyan-200"
                            onChange={(e) => setData('cover', e.target.files?.[0] || null)}
                            aria-label="Upload cover e-book"
                        />
                        <p className="mt-1 text-xs text-gray-500">Format: JPG/PNG, maksimal 2MB</p>
                        {errors.cover && <p className="mt-1 text-sm text-red-600">{errors.cover}</p>}
                    </div>
                    {coverPreview && (
                        <div className="w-full max-w-xs">
                            <img src={coverPreview} alt="Preview Cover" className="mt-2 w-full rounded-md border object-cover shadow" />
                        </div>
                    )}
                    <div className="flex items-center gap-2 pt-2">
                        <input
                            id="is_new"
                            type="checkbox"
                            className="h-4 w-4 rounded border-gray-300 text-blue-600"
                            checked={data.is_new}
                            onChange={(e) => setData('is_new', e.target.checked)}
                        />
                        <label htmlFor="is_new" className="text-sm text-gray-700">
                            Tampilkan badge <span className="font-bold text-blue-600">BARU</span>
                        </label>
                    </div>
                    <div className="flex flex-col-reverse items-stretch justify-end gap-2 pt-4 sm:flex-row sm:items-center">
                        {selectedEbookId && (
                            <button
                                type="button"
                                onClick={() => {
                                    reset();
                                    setCoverPreview(null);
                                    setSelectedEbookId(null);
                                }}
                                className="rounded-lg bg-gray-400 px-6 py-2 text-sm font-semibold text-white hover:bg-gray-500"
                            >
                                Batal Edit
                            </button>
                        )}
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:opacity-60"
                        >
                            {processing ? 'Memproses...' : selectedEbookId ? 'Simpan Perubahan' : 'Unggah E-Book'}
                        </button>
                    </div>
                </form>

                {/* --- DAFTAR E-BOOK  --- */}
                {ebooks.length > 0 && (
                    <div className="mt-10">
                        <h2 className="mb-4 text-lg font-bold text-gray-800">📚 Daftar E-Book</h2>
                        {/* Table wrapper agar bisa di-scroll di HP */}
                        <div className="overflow-x-auto rounded-lg border bg-white shadow">
                            <table className="w-full min-w-[650px] divide-y divide-gray-200 text-sm">
                                <thead className="bg-blue-50 text-xs text-blue-700 uppercase">
                                    <tr>
                                        <th className="px-3 py-2 text-left">Cover</th>
                                        <th className="px-3 py-2 text-left">Judul</th>
                                        <th className="max-w-[140px] px-3 py-2 text-left">Deskripsi</th>
                                        <th className="px-3 py-2 text-left">Aksi</th>
                                        <th className="px-3 py-2 text-left">Badge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {ebooks.map((ebook) => (
                                        <tr key={ebook.id} className="transition hover:bg-blue-50">
                                            <td className="px-3 py-2">
                                                <img src={ebook.image} alt={ebook.title} className="h-12 w-9 rounded object-cover sm:h-16 sm:w-12" />
                                            </td>
                                            <td className="max-w-[120px] px-3 py-2 font-semibold break-words text-blue-800 sm:max-w-xs">
                                                <span className="line-clamp-2">{ebook.title}</span>
                                            </td>
                                            <td className="max-w-[140px] px-3 py-2 break-words text-gray-700">
                                                <span className="line-clamp-2">{ebook.description}</span>
                                            </td>
                                            <td className="px-3 py-2">
                                                <div className="flex flex-wrap gap-2">
                                                    <a
                                                        href={ebook.file}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        className="rounded bg-blue-500 px-2 py-1 text-xs text-white hover:bg-blue-700"
                                                        title="Download"
                                                    >
                                                        📥
                                                    </a>
                                                    <button
                                                        onClick={() => handleEditEbook(ebook)}
                                                        className="rounded bg-yellow-400 px-2 py-1 text-xs text-white hover:bg-yellow-500"
                                                        title="Edit"
                                                    >
                                                        ✏
                                                    </button>
                                                    <button
                                                        onClick={() => handleDeleteEbook(ebook.id)}
                                                        className="rounded bg-red-500 px-2 py-1 text-xs text-white hover:bg-red-600"
                                                        title="Hapus"
                                                    >
                                                        🗑
                                                    </button>
                                                </div>
                                            </td>
                                            <td className="px-3 py-2">
                                                {ebook.is_new && (
                                                    <span className="rounded-full bg-green-100 px-2 py-0.5 text-xs font-bold text-green-700">
                                                        BARU
                                                    </span>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
