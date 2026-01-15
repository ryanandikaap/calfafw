import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { fetchJson } from '../lib/api';

const Home = () => {
    const [sliders, setSliders] = useState([]);
    const [treatments, setTreatments] = useState([]);
    const [news, setNews] = useState([]);

    useEffect(() => {
        const load = async () => {
            try {
                const [sliderData, treatmentData, newsData] = await Promise.all([
                    fetchJson('/api/sliders?status=aktif'),
                    fetchJson('/api/treatments'),
                    fetchJson('/api/news'),
                ]);
                setSliders(sliderData);
                setTreatments(treatmentData);
                setNews(newsData);
            } catch (error) {
                // No-op: fallback UI handles empty state.
            }
        };

        load();
    }, []);

    const heroImage = sliders.length
        ? `/uploads/slider/${sliders[0].image}`
        : '/images/salon.jpeg';

    return (
        <div>
            <section className="relative">
                <img src={heroImage} className="w-full h-[420px] object-cover brightness-50" />
                <div className="absolute inset-0 flex items-center px-6 md:px-20 text-white">
                    <div className="max-w-xl">
                        <p className="uppercase tracking-[0.3em] text-xs mb-4">Calfa Hair & Beauty</p>
                        <h1 className="text-4xl md:text-5xl font-bold mb-4">Beauty Crafted with Precision & Care</h1>
                        <p className="text-gray-200 text-sm md:text-base">
                            Salon premium di Surabaya untuk perawatan rambut, wajah, dan kecantikan dengan hasil
                            profesional.
                        </p>
                        <div className="mt-8 flex flex-wrap gap-3">
                            <Link
                                to="/treatment"
                                className="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-md text-sm"
                            >
                                Lihat Treatment
                            </Link>
                            <a
                                href="https://wa.me/6282224422295"
                                target="_blank"
                                rel="noreferrer"
                                className="border border-white text-white px-6 py-3 rounded-md text-sm"
                            >
                                Konsultasi WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section className="max-w-7xl mx-auto px-6 py-20">
                <div className="flex items-end justify-between mb-10">
                    <div>
                        <p className="text-xs uppercase tracking-[0.3em] text-gray-400 mb-2">Services</p>
                        <h2 className="text-3xl font-bold">Treatment Populer</h2>
                    </div>
                    <Link to="/treatment" className="text-sm text-pink-600 hover:underline">
                        Lihat semua
                    </Link>
                </div>

                {treatments.length === 0 ? (
                    <p className="text-gray-500">Belum ada data treatment.</p>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        {treatments.slice(0, 6).map((item) => (
                            <div key={item.id} className="bg-white rounded-xl shadow-md overflow-hidden">
                                <img
                                    src={item.image || '/images/hairstyling.jpeg'}
                                    className="w-full h-44 object-cover"
                                />
                                <div className="p-6">
                                    <p className="text-xs uppercase text-gray-400">{item.category}</p>
                                    <h3 className="text-lg font-semibold">{item.name}</h3>
                                    <p className="text-sm text-gray-600 mt-2">{item.description}</p>
                                    <p className="text-pink-600 font-semibold mt-4">
                                        Rp {Number(item.price).toLocaleString('id-ID')}
                                    </p>
                                </div>
                            </div>
                        ))}
                    </div>
                )}
            </section>

            <section className="bg-gray-50 py-16">
                <div className="max-w-7xl mx-auto px-6">
                    <div className="flex items-end justify-between mb-10">
                        <div>
                            <p className="text-xs uppercase tracking-[0.3em] text-gray-400 mb-2">Journal</p>
                            <h2 className="text-3xl font-bold">Berita & Promo</h2>
                        </div>
                        <Link to="/news" className="text-sm text-pink-600 hover:underline">
                            Lihat semua
                        </Link>
                    </div>

                    {news.length === 0 ? (
                        <p className="text-gray-500">Belum ada berita terbaru.</p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {news.slice(0, 3).map((item) => (
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
                                            <p className="text-sm text-gray-600 mt-2">
                                                {item.short_desc}
                                            </p>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    )}
                </div>
            </section>

            <section className="bg-pink-50 py-16 text-center">
                <h2 className="text-3xl font-bold mb-2">Ready to Feel Beautiful?</h2>
                <p className="text-gray-600 max-w-xl mx-auto mb-6">
                    Jadwalkan sesi perawatan atau konsultasi langsung dengan tim profesional kami.
                </p>
                <a
                    href="https://wa.me/6282224422295"
                    target="_blank"
                    rel="noreferrer"
                    className="bg-pink-600 hover:bg-pink-700 text-white px-8 py-3 rounded-md"
                >
                    Hubungi via WhatsApp
                </a>
            </section>
        </div>
    );
};

export default Home;
