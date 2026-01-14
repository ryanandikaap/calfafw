import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import { fetchJson } from '../lib/api';

const NewsDetail = () => {
    const { id } = useParams();
    const [detail, setDetail] = useState(null);
    const [error, setError] = useState(false);

    useEffect(() => {
        const load = async () => {
            try {
                const data = await fetchJson(`/api/news/${id}`);
                setDetail(data);
            } catch (err) {
                setError(true);
            }
        };

        load();
    }, [id]);

    if (error) {
        return (
            <div className="max-w-4xl mx-auto px-6 py-20">
                <p className="text-gray-500 mb-4">Berita tidak ditemukan.</p>
                <Link to="/news" className="text-pink-600 hover:underline">
                    Kembali ke News
                </Link>
            </div>
        );
    }

    if (!detail) {
        return <div className="max-w-4xl mx-auto px-6 py-20">Memuat...</div>;
    }

    return (
        <div className="max-w-4xl mx-auto px-6 py-20">
            <Link to="/news" className="text-sm text-pink-600 hover:underline">
                &larr; Kembali
            </Link>
            <h1 className="text-3xl font-bold mt-4">{detail.title}</h1>
            <p className="text-sm text-gray-400 mt-2 uppercase">{detail.category}</p>
            <img
                src={detail.image ? `/uploads/news/${detail.image}` : '/images/new.png'}
                className="w-full h-64 object-cover rounded-xl mt-6"
            />
            <p className="text-gray-600 mt-6 leading-relaxed">{detail.content || detail.short_desc}</p>
        </div>
    );
};

export default NewsDetail;
