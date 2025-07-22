import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import { Editor } from '@tinymce/tinymce-react';
import { FilePenLine, Trash2 } from 'lucide-react';
import React, { useRef, useState } from 'react';
import Swal from 'sweetalert2';

// --- Type Definitions ---
type Artikel = {
    id: number;
    title: string;
    description: string;
    image: string;
    author: string;
    date: string;
    content: string;
    is_new: boolean;
};

type FormData = {
    title: string;
    author: string;
    date: string;
    content: string;
    is_new: boolean;
    image: File | null;
};

// --- Breadcrumbs ---
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: route('dashboard') },
    { title: 'Manajemen Artikel', href: route('artikel.create') },
];

// =================================================================================
// KOMPONEN: Item Daftar Artikel (untuk tampilan yang lebih rapi)
// =================================================================================
const ArtikelListItem: React.FC<{ artikel: Artikel; onEdit: (artikel: Artikel) => void; onDelete: (id: number) => void }> = ({
    artikel,
    onEdit,
    onDelete,
}) => (
    <div className="flex items-center justify-between rounded-lg border bg-white p-3 transition-shadow duration-300 hover:shadow-md">
        <div className="flex flex-1 items-center gap-4 overflow-hidden">
            <img src={artikel.image} alt={artikel.title} className="h-16 w-24 flex-shrink-0 rounded-md bg-gray-100 object-cover" />
            <div className="flex-1 overflow-hidden">
                <h3 className="truncate font-semibold text-gray-800">{artikel.title}</h3>
                <p className="truncate text-sm text-gray-500">{artikel.description}</p>
            </div>
        </div>
        <div className="flex flex-shrink-0 gap-2 pl-4">
            <button
                onClick={() => onEdit(artikel)}
                className="rounded-md bg-yellow-500 p-2 text-white transition-colors duration-200 hover:bg-yellow-600"
                aria-label="Edit"
            >
                <FilePenLine size={16} />
            </button>
            <button
                onClick={() => onDelete(artikel.id)}
                className="rounded-md bg-red-500 p-2 text-white transition-colors duration-200 hover:bg-red-600"
                aria-label="Hapus"
            >
                <Trash2 size={16} />
            </button>
        </div>
    </div>
);

// =================================================================================
// KOMPONEN UTAMA HALAMAN MANAJEMEN ARTIKEL
// =================================================================================
export default function ArtikelCreatePage({ artikels }: { artikels: Artikel[] }) {
    const [isEditing, setIsEditing] = useState(false);
    const [editId, setEditId] = useState<number | null>(null);
    const formRef = useRef<HTMLFormElement | null>(null);

    const { data, setData, post, processing, errors, reset } = useForm<FormData>({
        title: '',
        author: 'Kader Posyandu Kalangdosari',
        date: new Date().toISOString().split('T')[0],
        content: '<p>Tulis isi lengkap artikel di sini.</p>',
        is_new: true,
        image: null,
    });

    const handleEdit = (artikel: Artikel) => {
        setIsEditing(true);
        setEditId(artikel.id);
        setData({
            title: artikel.title,
            author: artikel.author,
            date: artikel.date,
            content: artikel.content,
            is_new: artikel.is_new,
            image: null,
        });
        formRef.current?.scrollIntoView({ behavior: 'smooth' });
    };

    const handleDelete = (id: number) => {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Artikel yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('artikel.destroy', id), {
                    onSuccess: () => Swal.fire('Terhapus!', 'Artikel telah dihapus.', 'success'),
                });
            }
        });
    };

    const resetForm = () => {
        reset();
        setIsEditing(false);
        setEditId(null);
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const url = isEditing ? route('artikel.update', editId!) : route('artikel.store');

        router.post(
            url,
            {
                _method: isEditing ? 'post' : 'post',
                ...data,
            },
            {
                onSuccess: () => {
                    resetForm();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: `Artikel berhasil di${isEditing ? 'perbarui' : 'simpan'}!`,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                },
                onError: () => Swal.fire('Gagal', 'Periksa kembali isian form Anda.', 'error'),
            },
        );
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Manajemen Artikel" />
            <div className="flex h-full flex-1 flex-col gap-8 rounded-xl p-4">
                {/* FORM INPUT / EDIT */}
                <form ref={formRef} onSubmit={handleSubmit} className="grid grid-cols-1 gap-6 rounded-xl border bg-white p-6 shadow md:grid-cols-2">
                    <h2 className="mb-2 text-xl font-bold text-blue-800 md:col-span-2">
                        {isEditing ? `✏️ Mengedit Artikel: ${data.title}` : 'Formulir Tambah Artikel'}
                    </h2>

                    {/* Judul Artikel */}
                    <div className="md:col-span-2">
                        <label htmlFor="title" className="mb-1 block text-sm font-semibold text-gray-700">
                            Judul Artikel <span className="text-red-500">*</span>
                        </label>
                        <input
                            id="title"
                            type="text"
                            placeholder="Contoh: Pentingnya Gizi Seimbang Sejak Dini"
                            value={data.title}
                            onChange={(e) => setData('title', e.target.value)}
                            className="w-full rounded-md border border-gray-300 px-4 py-2 text-base focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            required
                        />
                        {errors.title && <div className="mt-1 text-sm text-red-600">{errors.title}</div>}
                    </div>

                    {/* Penulis */}
                    <div>
                        <label htmlFor="author" className="mb-1 block text-sm font-semibold text-gray-700">
                            Penulis <span className="text-red-500">*</span>
                        </label>
                        <input
                            id="author"
                            type="text"
                            placeholder="Nama Penulis (misal: Dr. Andi Wibowo)"
                            value={data.author}
                            onChange={(e) => setData('author', e.target.value)}
                            className="w-full rounded-md border border-gray-300 px-4 py-2 text-base focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            required
                        />
                        {errors.author && <div className="mt-1 text-sm text-red-600">{errors.author}</div>}
                    </div>

                    {/* Tanggal Terbit */}
                    <div>
                        <label htmlFor="date" className="mb-1 block text-sm font-semibold text-gray-700">
                            Tanggal Terbit <span className="text-red-500">*</span>
                        </label>
                        <input
                            id="date"
                            type="date"
                            placeholder="yyyy-mm-dd"
                            value={data.date}
                            onChange={(e) => setData('date', e.target.value)}
                            className="w-full rounded-md border border-gray-300 px-4 py-2 text-base focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            required
                        />
                        {errors.date && <div className="mt-1 text-sm text-red-600">{errors.date}</div>}
                    </div>

                    {/* Isi Konten */}
                    <div className="md:col-span-2">
                        <label htmlFor="content" className="mb-1 block text-sm font-semibold text-gray-700">
                            Isi Konten <span className="text-red-500">*</span>
                        </label>
                        <Editor
                            apiKey="e7wsufk6vke48ny9oledfxj90sjn4jehywcjam221o4nvcds"
                            value={data.content}
                            onEditorChange={(content) => setData('content', content)}
                            init={{
                                height: 350,
                                menubar: true,
                                plugins: [
                                    'advlist',
                                    'autolink',
                                    'lists',
                                    'link',
                                    'image',
                                    'charmap',
                                    'preview',
                                    'anchor',
                                    'searchreplace',
                                    'visualblocks',
                                    'code',
                                    'fullscreen',
                                    'insertdatetime',
                                    'media',
                                    'table',
                                    'help',
                                    'wordcount',
                                    'autoresize',
                                    'codesample',
                                    'emoticons',
                                    'hr',
                                    'pagebreak',
                                    'nonbreaking',
                                ],
                                toolbar:
                                    'undo redo | blocks | bold italic underline strikethrough | ' +
                                    'forecolor backcolor | fontselect fontsizeselect | alignleft aligncenter ' +
                                    'alignright alignjustify | bullist numlist outdent indent | ' +
                                    'link image media table codesample | blockquote hr pagebreak | ' +
                                    'removeformat | fullscreen preview | help',
                                images_upload_url: '/your-upload-handler',
                                images_upload_credentials: true,
                                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                                placeholder: 'Tulis isi artikel di sini...',
                            }}
                        />
                        {errors.content && <div className="mt-1 text-sm text-red-600">{errors.content}</div>}
                    </div>

                    {/* Gambar Utama */}
                    <div className="md:col-span-2">
                        <label htmlFor="image" className="mb-1 block text-sm font-semibold text-gray-700">
                            Gambar Utama (Cover)
                        </label>
                        <input
                            id="image"
                            type="file"
                            accept="image/*"
                            onChange={(e) => {
                                const file = e.target.files ? e.target.files[0] : null;
                                const maxSize = 5 * 1024 * 1024; // 5MB

                                if (file && file.size > maxSize) {
                                    // === PERBAIKAN: Menggunakan Swal.fire untuk notifikasi ===
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ukuran File Terlalu Besar',
                                        text: 'Ukuran gambar tidak boleh melebihi 5MB. Silakan pilih file lain.',
                                    });
                                    // Reset input file agar file yang terlalu besar tidak terpilih
                                    e.target.value = '';
                                    setData('image', null);
                                    return;
                                }
                                setData('image', file);
                            }}
                            className="w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-100 file:px-4 file:py-2 file:font-semibold file:text-blue-700 hover:file:bg-blue-200"
                        />
                        {isEditing && <p className="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>}
                        {errors.image && <div className="mt-1 text-sm text-red-600">{errors.image}</div>}
                        <p className="mt-1 text-xs text-gray-500">Maksimal ukuran gambar 5MB.</p>
                    </div>

                    {/* Checkbox NEW */}
                    <div className="flex items-center md:col-span-2">
                        <input
                            id="is_new"
                            type="checkbox"
                            checked={data.is_new}
                            onChange={(e) => setData('is_new', e.target.checked)}
                            className="h-4 w-4 rounded border-gray-300 text-blue-600"
                        />
                        <label htmlFor="is_new" className="ml-2 block text-sm text-gray-900">
                            Tampilkan badge <span className="font-bold text-blue-600">BARU</span> pada artikel?
                        </label>
                    </div>

                    {/* Tombol */}
                    <div className="flex justify-end gap-4 md:col-span-2">
                        {isEditing && (
                            <button
                                type="button"
                                onClick={resetForm}
                                className="rounded-md border bg-gray-100 px-6 py-2 font-semibold text-gray-700 transition hover:bg-gray-200"
                            >
                                Batal Edit
                            </button>
                        )}
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700 disabled:opacity-50"
                        >
                            {processing ? 'Menyimpan...' : isEditing ? 'Update Artikel' : 'Simpan Artikel Baru'}
                        </button>
                    </div>
                </form>

                {/* DAFTAR ARTIKEL */}
                {artikels.length > 0 && (
                    <div className="rounded-xl border bg-white p-6 shadow">
                        <h2 className="mb-4 text-xl font-semibold text-gray-800">📰 Daftar Artikel yang Sudah Ada</h2>
                        <div className="space-y-3">
                            {artikels.map((artikel) => (
                                <ArtikelListItem key={artikel.id} artikel={artikel} onEdit={handleEdit} onDelete={handleDelete} />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
