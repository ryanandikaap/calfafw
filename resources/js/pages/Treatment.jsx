import React, { useEffect, useState } from 'react';
import BookingForm from '../components/BookingForm';
import { fetchJson } from '../lib/api';

const Treatment = () => {
    const [treatments, setTreatments] = useState([]);

    useEffect(() => {
        const load = async () => {
            try {
                const data = await fetchJson('/api/treatments');
                setTreatments(data);
            } catch (error) {
                setTreatments([]);
            }
        };

        load();
    }, []);

    return (
        <div>
            <section className="relative">
                <img src="/images/hairstyling.jpeg" className="w-full h-[360px] object-cover brightness-50" />
                <div className="absolute inset-0 flex items-center px-6 md:px-20 text-white">
                    <div>
                        <h1 className="text-3xl md:text-4xl font-bold">Treatment & Services</h1>
                        <p className="text-gray-200 mt-2">Pilihan layanan terbaik untuk kebutuhan kecantikan Anda.</p>
                    </div>
                </div>
            </section>

            <section className="max-w-7xl mx-auto px-6 py-16">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <div className="lg:col-span-2">
                        <h2 className="text-2xl font-bold mb-6">Daftar Treatment</h2>
                        {treatments.length === 0 ? (
                            <p className="text-gray-500">Belum ada data treatment.</p>
                        ) : (
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {treatments.map((item) => (
                                    <div key={item.id} className="bg-white rounded-xl shadow-md overflow-hidden">
                                        <img
                                            src={item.image || '/images/hairstyling.jpeg'}
                                            className="w-full h-44 object-cover"
                                        />
                                        <div className="p-5">
                                            <p className="text-xs uppercase text-gray-400">{item.category}</p>
                                            <h3 className="text-lg font-semibold">{item.name}</h3>
                                            <p className="text-sm text-gray-600 mt-2">
                                                {item.description}
                                            </p>
                                            <p className="text-pink-600 font-semibold mt-3">
                                                Rp {Number(item.price).toLocaleString('id-ID')}
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>

                    <div>
                        <BookingForm treatments={treatments} />
                    </div>
                </div>
            </section>
        </div>
    );
};

export default Treatment;
