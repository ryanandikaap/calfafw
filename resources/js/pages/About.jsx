import React from 'react';

const About = () => (
    <div>
        <section className="relative">
            <img src="/images/salon.jpeg" className="w-full h-[360px] object-cover brightness-50" />
            <div className="absolute inset-0 flex items-center px-6 md:px-20 text-white">
                <h1 className="text-3xl md:text-4xl font-bold">About Calfa Hair & Beauty</h1>
            </div>
        </section>

        <section className="max-w-7xl mx-auto px-6 py-20">
            <div className="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 className="text-3xl md:text-4xl font-semibold mb-6">
                        Di Mana Kecantikan Bertemu Kepercayaan Diri
                    </h2>
                    <p className="text-gray-600 leading-relaxed mb-5">
                        Calfa Hair & Beauty adalah salon premium yang menghadirkan layanan profesional untuk
                        menonjolkan kecantikan alami Anda dengan sentuhan modern dan produk berkualitas tinggi.
                    </p>
                    <p className="text-gray-600 leading-relaxed mb-5">
                        Kami percaya bahwa kecantikan bukan hanya tentang penampilan, tetapi juga tentang rasa percaya
                        diri dan kenyamanan. Dengan tenaga ahli berpengalaman, kami berkomitmen memberikan perawatan
                        personal yang sesuai dengan karakter dan gaya Anda.
                    </p>
                    <p className="text-gray-600 leading-relaxed">
                        Mulai dari penataan rambut, perawatan wajah, nail art, hingga relaksasi, Calfa Hair & Beauty
                        hadir sebagai destinasi terpercaya untuk perawatan kecantikan menyeluruh.
                    </p>
                </div>
                <div className="relative">
                    <img
                        src="/images/ow.PNG"
                        alt="Salon Stylist"
                        className="w-full h-[520px] object-cover rounded-2xl shadow-lg"
                    />
                </div>
            </div>
        </section>

        <section className="py-20 px-6 md:px-20 bg-white">
            <div className="max-w-6xl mx-auto text-center mb-14">
                <h2 className="text-3xl font-bold mb-4">Meet Our Team</h2>
                <p className="text-gray-600">Professionals behind Calfa Hair & Beauty</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto mb-20">
                {[
                    {
                        name: 'Calfa Owner',
                        role: 'Founder & Creative Director',
                        desc: 'Pendiri Calfa Hair and Beauty dengan pengalaman bertahun-tahun di dunia hair styling.',
                        image: '/images/ownerlaki.png',
                    },
                    {
                        name: 'Calfa Owner',
                        role: 'Founder & Creative Director',
                        desc: 'Berfokus pada hasil yang elegan, natural, dan premium untuk setiap pelanggan.',
                        image: '/images/ownercal.png',
                    },
                ].map((owner) => (
                    <div
                        key={owner.image}
                        className="relative text-center bg-white p-10 rounded-2xl shadow-lg hover:-translate-y-2 transition"
                    >
                        <span className="absolute -top-4 left-1/2 -translate-x-1/2 bg-pink-500 text-white text-xs px-4 py-1 rounded-full tracking-widest">
                            OWNER
                        </span>
                        <div className="relative inline-block mb-6">
                            <div className="absolute inset-0 rounded-full bg-gradient-to-tr from-pink-400 to-purple-500 blur-lg opacity-40" />
                            <img
                                src={owner.image}
                                className="relative w-40 h-40 rounded-full object-cover border-4 border-white shadow-xl"
                            />
                        </div>
                        <h3 className="text-2xl font-bold tracking-wide">{owner.name}</h3>
                        <p className="text-pink-500 text-sm mb-4 uppercase tracking-wider">{owner.role}</p>
                        <p className="text-gray-600 text-sm leading-relaxed">{owner.desc}</p>
                    </div>
                ))}
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl mx-auto">
                {[
                    { name: 'Miar Hair Stylist', title: 'Senior Hair Stylist', image: '/images/hairstylist1.jpg' },
                    { name: 'Ira Hair Stylist', title: 'Professional Hair Stylist', image: '/images/1.png' },
                    { name: 'Sari Hair Stylist', title: 'Professional Hair Stylist', image: '/images/ui.png' },
                    { name: 'Putri Hair Stylist', title: 'Professional Hair Stylist', image: '/images/putt.png' },
                    { name: 'Habibah', title: 'Administrator', image: '/images/hairstylist2.jpg' },
                    { name: 'Fara', title: 'Administrator', image: '/images/hairstylist2.jpg' },
                ].map((member) => (
                    <div key={member.name} className="text-center bg-gray-50 p-8 rounded-xl shadow-md">
                        <img src={member.image} className="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg" />
                        <h3 className="text-xl font-bold">{member.name}</h3>
                        <p className="text-pink-500 text-sm mb-4">{member.title}</p>
                        <p className="text-gray-600 text-sm leading-relaxed">
                            Berpengalaman melayani pelanggan dengan standar salon premium dan konsultasi yang detail.
                        </p>
                    </div>
                ))}
            </div>
        </section>

        <section className="bg-gray-100 py-20 px-6 md:px-20">
            <div className="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <div className="bg-white p-8 rounded-xl shadow-md">
                    <h3 className="text-xl font-bold mb-4">Our Vision</h3>
                    <ul className="text-gray-600 space-y-3 list-disc pl-5">
                        <li>
                            Menjadi pilihan utama salon kecantikan untuk memecahkan masalah dan memberikan solusi
                            kecantikan.
                        </li>
                        <li>Menjadikan CALFA SALON sebagai brand owner yang diakui dan menjadi inspirasi.</li>
                    </ul>
                </div>

                <div className="bg-white p-8 rounded-xl shadow-md">
                    <h3 className="text-xl font-bold mb-4">Our Mission</h3>
                    <ul className="text-gray-600 space-y-3 list-disc pl-5">
                        <li>Menghadirkan layanan berkualitas dengan produk aman dan ter-approve BPOM.</li>
                        <li>Memberikan mutu pelayanan terbaik bagi pelanggan.</li>
                        <li>Menyediakan terapis, beautician, dan hairdresser yang berkompeten.</li>
                        <li>Berinovasi dengan teknologi terbaru sesuai perkembangan industri.</li>
                        <li>Memperluas jangkauan promosi melalui sosial media yang berkembang.</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
);

export default About;
