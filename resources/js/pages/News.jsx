import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { fetchJson } from '../lib/api';

const News = () => {
    const [news, setNews] = useState([]);

    useEffect(() => {
        const load = async () => {
            try {
                const data = await fetchJson('/api/news');
                setNews(data);
            } catch (error) {
                setNews([]);
            }
        };

        load();
    }, []);

    return (
        <div>
            <section className="relative">
                <img src="/images/salon.jpeg" className="w-full h-[320px] object-cover brightness-50" />
                <div className="absolute inset-0 flex items-center px-6 md:px-20 text-white">
                    <div>
                        <h1 className="text-3xl md:text-4xl font-bold">News & Promo</h1>
                        <p className="text-gray-200 mt-2">Update terbaru dari Calfa Hair & Beauty.</p>
                    </div>
                </div>
            </section>

            <section className="max-w-7xl mx-auto px-6 py-16">
                {news.length === 0 ? (
                    <p className="text-gray-500">Belum ada berita.</p>
                ) : (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {news.map((item) => (
                            <Link key={item.id} to={`/news/${item.id}`} className="group">
                                <div className="bg-white rounded-xl shadow overflow-hidden">
                                    <img
                                        src={item.image ? `/uploads/news/${item.image}` : '/images/new.png'}
                                        className="w-full h-44 object-cover"
                                    />
                                    <div className="p-6">
                                        <p className="text-xs uppercase text-gray-400">{item.category}</p>
                                        <h3 className="text-lg font-semibold group-hover:text-pink-600 transition">
                                            {item.title}
                                        </h3>
                                        <p className="text-sm text-gray-600 mt-2">{item.short_desc}</p>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                )}
            </section>
        </div>
    );
};

export default News;
