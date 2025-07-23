'use client';

import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

// Asumsi komponen-komponen ini sudah ada di proyek Anda
import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

// --- Type Definition ---
type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
}

// =================================================================================
// KOMPONEN UTAMA HALAMAN LOGIN
// =================================================================================
export default function Login({ status, canResetPassword }: LoginProps) {
    const { data, setData, post, processing, errors, reset } = useForm<Required<LoginForm>>({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <>
            <Head title="Log in" />
            <div className="min-h-screen w-full lg:grid lg:grid-cols-2">
                {/* Panel Kiri: Gambar dan Branding (disembunyikan di mobile) */}
                <div className="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex">
                    <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: "url('/storage/dipakelagi.jpg')" }} />
                    <div className="absolute inset-0 bg-black/50" />
                    <div className="relative z-20 flex items-center text-lg font-medium">
                        <img src="/storage/logo.png" alt="P2SA Logo" className="mr-2 h-10 w-10 object-contain" />
                        Peta Tumbuh Kalangdosari
                    </div>
                    <div className="relative z-20 mt-auto">
                        <blockquote className="space-y-2">
                            <p className="text-lg">
                                “Setiap data yang Anda masukkan adalah langkah nyata dalam perjuangan kita bersama melawan stunting. Terima kasih atas
                                dedikasi Anda.”
                            </p>
                            <footer className="text-sm">Tim Kesehatan Desa</footer>
                        </blockquote>
                    </div>
                </div>

                {/* Panel Kanan: Form Login (menjadi layout utama di mobile) */}
                <div
                    className="flex min-h-screen items-center justify-center bg-cover bg-center p-4 lg:py-12"
                    style={{ backgroundImage: "url('/storage/bg-test.png')" }}
                >
                    <div className="mx-auto w-full max-w-md gap-6 rounded-xl border bg-white/80 p-10 shadow-xl backdrop-blur-sm">
                        <div className="grid gap-4 text-center">
                            <h1 className="text-3xl font-bold text-blue-700">Login Petugas</h1>
                            <p className="text-sm text-gray-600">Masukkan email dan password Anda untuk mengakses dashboard.</p>
                        </div>

                        <form className="mt-8 space-y-6" onSubmit={submit}>
                            <div className="grid gap-4">
                                <div>
                                    <Label htmlFor="email" className="text-lg">
                                        Email
                                    </Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        required
                                        autoFocus
                                        autoComplete="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        placeholder="email@example.com"
                                        className="w-full rounded-md border-2 border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                    />
                                    <InputError message={errors.email} />
                                </div>

                                <div>
                                    <div className="flex items-center justify-between">
                                        <Label htmlFor="password" className="text-lg">
                                            Password
                                        </Label>
                                        {canResetPassword && (
                                            <TextLink href={route('password.request')} className="text-sm text-blue-500 hover:underline">
                                                Lupa password?
                                            </TextLink>
                                        )}
                                    </div>
                                    <Input
                                        id="password"
                                        type="password"
                                        required
                                        autoComplete="current-password"
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        placeholder="Password"
                                        className="w-full rounded-md border-2 border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                    />
                                    <InputError message={errors.password} />
                                </div>

                                <div className="flex items-center space-x-3">
                                    <Checkbox
                                        id="remember"
                                        name="remember"
                                        checked={data.remember}
                                        onClick={() => setData('remember', !data.remember)}
                                        className="h-5 w-5"
                                    />
                                    <Label htmlFor="remember" className="text-sm">
                                        Ingat saya
                                    </Label>
                                </div>

                                <Button
                                    type="submit"
                                    className="w-full rounded-md bg-blue-600 py-3 text-lg text-white transition-colors hover:bg-blue-700"
                                >
                                    {processing && <LoaderCircle className="mr-2 h-4 w-4 animate-spin" />}
                                    Login
                                </Button>
                            </div>

                            {status && <div className="mt-4 text-center text-sm font-medium text-green-600">{status}</div>}
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}
