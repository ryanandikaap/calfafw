import React from 'react';
import { Link } from 'react-router-dom';

const NotFound = () => (
    <div className="min-h-[60vh] flex flex-col items-center justify-center px-6 text-center">
        <h1 className="text-4xl font-bold mb-3">404</h1>
        <p className="text-gray-600 mb-6">Halaman tidak ditemukan.</p>
        <Link to="/" className="text-pink-600 hover:underline">
            Kembali ke Home
        </Link>
    </div>
);

export default NotFound;
