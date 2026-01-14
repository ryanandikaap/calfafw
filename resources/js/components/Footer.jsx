import React from 'react';

const Footer = () => (
    <footer className="bg-black text-white px-6 md:px-20 py-12">
        <div className="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <img src="/images/new.png" alt="Calfa Salon" className="h-12 md:h-10 mb-3" />
                <p>Calfa Beauty Salon</p>
                <p className="text-gray-400 text-sm">Surabaya, Indonesia</p>
            </div>

            <div>
                <h3 className="font-bold mb-4 text-lg">Contact</h3>
                <p className="mb-2 text-sm">
                    WhatsApp:{' '}
                    <a
                        href="https://wa.me/6282224422295"
                        target="_blank"
                        rel="noreferrer"
                        className="text-pink-500 hover:underline"
                    >
                        +62 822-2442-2295
                    </a>
                </p>
                <p className="mb-2 text-sm">
                    Email:{' '}
                    <a href="mailto:calfasalon@gmail.com" className="text-pink-500 hover:underline">
                        calfasalon@gmail.com
                    </a>
                </p>
                <p className="text-sm text-gray-400">Senin-Selasa & Jumat-Minggu, 08:00 - 21:00</p>
                <p className="text-sm text-gray-400">Rabu & Kamis, 10:00 - 20:00</p>
            </div>

            <div>
                <h3 className="font-bold mb-4 text-lg">Follow Us</h3>
                <div className="flex space-x-4 mb-6 text-white">
                    <a
                        href="https://www.instagram.com/calfasalonsurabaya/?__pwa=1"
                        target="_blank"
                        rel="noreferrer"
                        className="hover:text-pink-500 transition"
                    >
                        <span className="sr-only">Instagram</span>
                        <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7.75 2C4.57 2 2 4.57 2 7.75v8.5C2 19.43 4.57 22 7.75 22h8.5C19.43 22 22 19.43 22 16.25v-8.5C22 4.57 19.43 2 16.25 2h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm5.25-.75a1 1 0 1 1 0 2 1 1 0 0 1 0-2ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                        </svg>
                    </a>
                    <a
                        href="https://www.tiktok.com/@calfasalonsurabaya"
                        target="_blank"
                        rel="noreferrer"
                        className="hover:text-pink-500 transition"
                    >
                        <span className="sr-only">TikTok</span>
                        <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 8.3a6.7 6.7 0 0 1-4.3-1.6v7.6a5.5 5.5 0 1 1-5.5-5.5v3a2.5 2.5 0 1 0 2.5 2.5V2h3a6.7 6.7 0 0 0 4.3 4.3v2Z" />
                        </svg>
                    </a>
                </div>
                <a
                    href="https://search.google.com/local/writereview?placeid=ChIJDcRDgbf_1y0R0YBRAIZTGrs"
                    target="_blank"
                    rel="noreferrer"
                    className="inline-block border border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white px-6 py-2 rounded-lg text-sm font-semibold transition"
                >
                    Leave a Google Review
                </a>
            </div>
        </div>

        <p className="text-gray-400 text-xs mt-10 text-center">
            &copy; 2025 Calfa Hair & Beauty. All rights reserved.
        </p>
    </footer>
);

export default Footer;
