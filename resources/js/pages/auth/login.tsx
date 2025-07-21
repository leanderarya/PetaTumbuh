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
                {/* Panel Kiri: Gambar dan Branding */}
                <div className="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex">
                    <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: "url('/storage/dipakelagi.jpg')" }} />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent" />
                    <div className="relative z-20 flex items-center text-lg font-medium">
                        <img src="/storage/logo.png" alt="P2SA Logo" className="mr-2 h-10 w-10 object-contain" />
                        Tambuh Kalangdosari
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

                {/* Panel Kanan: Form Login */}
                <div className="flex items-center justify-center py-12" style={{ backgroundImage: "url('/storage/bg-test.png')" }}>
                    <div className="mx-auto grid w-[380px] gap-6 rounded-xl border bg-white/90 p-8 shadow-2xl backdrop-blur-sm">
                        <div className="grid gap-2 text-center">
                            <h1 className="text-3xl font-bold">Login Petugas</h1>
                            <p className="text-balance text-muted-foreground">Masukkan email dan password Anda untuk mengakses dashboard.</p>
                        </div>

                        <form className="grid gap-4" onSubmit={submit}>
                            <div className="grid gap-2">
                                <Label htmlFor="email">Email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="email@example.com"
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center">
                                    <Label htmlFor="password">Password</Label>
                                    {canResetPassword && (
                                        <TextLink href={route('password.request')} className="ml-auto text-sm" tabIndex={5}>
                                            Lupa password?
                                        </TextLink>
                                    )}
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    tabIndex={2}
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    placeholder="Password"
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="flex items-center space-x-3">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    checked={data.remember}
                                    onClick={() => setData('remember', !data.remember)}
                                    tabIndex={3}
                                />
                                <Label htmlFor="remember">Ingat saya</Label>
                            </div>

                            <Button type="submit" className="w-full bg-blue-600 text-white hover:bg-blue-700" tabIndex={4} disabled={processing}>
                                {processing && <LoaderCircle className="mr-2 h-4 w-4 animate-spin" />}
                                Login
                            </Button>
                        </form>

                        {/* <div className="mt-4 text-center text-sm">
                            Belum punya akun?{' '}
                            <TextLink href={route('register')} tabIndex={5}>
                                Daftar
                            </TextLink>
                        </div> */}

                        {status && <div className="mt-4 text-center text-sm font-medium text-green-600">{status}</div>}
                    </div>
                </div>
            </div>
        </>
    );
}
