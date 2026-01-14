import React from 'react';
import { courses } from '../data/courses';

const Kursus = () => (
    <div>
        <section className="relative">
            <img src="/images/krsus.png" className="w-full h-[320px] object-cover brightness-50" />
            <div className="absolute inset-0 flex items-center px-6 md:px-20 text-white">
                <div>
                    <h2 className="text-3xl md:text-4xl font-bold mb-3">CALFA ACADEMY</h2>
                    <p className="text-gray-200 max-w-md text-sm">
                        Belajar langsung dari mentor berpengalaman & bersertifikat.
                    </p>
                </div>
            </div>
        </section>

        <section className="py-20 px-6 md:px-20 max-w-7xl mx-auto">
            <p className="text-gray-400 uppercase text-sm mb-3">Calfa Academy</p>
            <h2 className="text-3xl font-bold mb-14">Program Kursus</h2>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                {courses.map((course) => (
                    <div key={course.title} className="bg-white rounded-xl shadow-md overflow-hidden">
                        <img src={course.image} className="w-full h-44 object-cover" />
                        <div className="p-6">
                            <h3 className="text-xl font-semibold">{course.title}</h3>
                            <p className="text-sm text-gray-600 my-3">{course.desc}</p>
                            <ul className="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
                                {course.highlight.map((item) => (
                                    <li key={item}>{item}</li>
                                ))}
                            </ul>
                            <p className="text-pink-600 font-bold text-lg mb-4">Rp {course.price}</p>
                            <a
                                href="https://wa.me/6282224422295"
                                target="_blank"
                                rel="noreferrer"
                                className="w-full inline-flex items-center justify-center bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md"
                            >
                                BOOK COURSE
                            </a>
                        </div>
                    </div>
                ))}
            </div>
        </section>

        <section className="bg-pink-50 py-16 px-6 md:px-20 text-center">
            <h2 className="text-3xl font-bold mb-2">Bangun Karier di Dunia Kecantikan</h2>
            <p className="text-gray-600 text-sm mb-6">
                Daftar kursus sekarang & mulai perjalanan profesionalmu.
            </p>
            <a
                href="https://wa.me/6282224422295"
                target="_blank"
                rel="noreferrer"
                className="bg-pink-600 hover:bg-pink-700 text-white px-8 py-3"
            >
                Konsultasi via WhatsApp
            </a>
        </section>
    </div>
);

export default Kursus;
