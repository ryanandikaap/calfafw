import React, { useMemo, useState } from 'react';
import { fetchJson } from '../lib/api';

const defaultForm = {
    name: '',
    treatment: '',
    price: '',
    booking_date: '',
    booking_time: '',
    gender: '',
    hairstylist: '',
    note: '',
};

const BookingForm = ({ treatments = [] }) => {
    const [form, setForm] = useState(defaultForm);
    const [file, setFile] = useState(null);
    const [status, setStatus] = useState({ type: '', message: '' });
    const [submitting, setSubmitting] = useState(false);

    const treatmentOptions = useMemo(
        () => treatments.map((item) => ({ name: item.name, price: item.price })),
        [treatments]
    );

    const handleChange = (event) => {
        const { name, value } = event.target;
        setForm((prev) => ({ ...prev, [name]: value }));

        if (name === 'treatment') {
            const found = treatmentOptions.find((item) => item.name === value);
            setForm((prev) => ({ ...prev, price: found ? String(found.price) : '' }));
        }
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        setSubmitting(true);
        setStatus({ type: '', message: '' });

        try {
            const payload = new FormData();
            Object.entries(form).forEach(([key, value]) => payload.append(key, value));

            if (file) {
                payload.append('bukti', file);
            }

            await fetchJson('/api/bookings', {
                method: 'POST',
                body: payload,
            });

            setStatus({ type: 'success', message: 'Booking berhasil dikirim. Tim kami akan menghubungi Anda.' });
            setForm(defaultForm);
            setFile(null);
        } catch (error) {
            setStatus({ type: 'error', message: 'Booking gagal. Silakan cek data dan coba lagi.' });
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <form onSubmit={handleSubmit} className="bg-white p-6 rounded-xl shadow-md space-y-4">
            <h3 className="text-xl font-semibold">Form Booking Treatment</h3>

            {status.message && (
                <div
                    className={`rounded px-4 py-3 text-sm ${
                        status.type === 'success' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'
                    }`}
                >
                    {status.message}
                </div>
            )}

            <div>
                <label className="text-sm font-medium">Nama</label>
                <input
                    name="name"
                    value={form.name}
                    onChange={handleChange}
                    className="w-full border px-3 py-2 rounded-md"
                    required
                />
            </div>

            <div>
                <label className="text-sm font-medium">Treatment</label>
                <select
                    name="treatment"
                    value={form.treatment}
                    onChange={handleChange}
                    className="w-full border px-3 py-2 rounded-md"
                    required
                >
                    <option value="">-- Pilih Treatment --</option>
                    {treatmentOptions.map((item) => (
                        <option key={item.name} value={item.name}>
                            {item.name}
                        </option>
                    ))}
                </select>
            </div>

            <div>
                <label className="text-sm font-medium">Harga (Rp)</label>
                <input
                    name="price"
                    value={form.price}
                    onChange={handleChange}
                    className="w-full border px-3 py-2 rounded-md"
                    required
                />
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label className="text-sm font-medium">Tanggal</label>
                    <input
                        type="date"
                        name="booking_date"
                        value={form.booking_date}
                        onChange={handleChange}
                        className="w-full border px-3 py-2 rounded-md"
                        required
                    />
                </div>
                <div>
                    <label className="text-sm font-medium">Jam</label>
                    <input
                        type="time"
                        name="booking_time"
                        value={form.booking_time}
                        onChange={handleChange}
                        className="w-full border px-3 py-2 rounded-md"
                        required
                    />
                </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label className="text-sm font-medium">Gender</label>
                    <select
                        name="gender"
                        value={form.gender}
                        onChange={handleChange}
                        className="w-full border px-3 py-2 rounded-md"
                        required
                    >
                        <option value="">-- Pilih Gender --</option>
                        <option value="Wanita">Wanita</option>
                        <option value="Pria">Pria</option>
                    </select>
                </div>
                <div>
                    <label className="text-sm font-medium">Hairstylist (opsional)</label>
                    <input
                        name="hairstylist"
                        value={form.hairstylist}
                        onChange={handleChange}
                        className="w-full border px-3 py-2 rounded-md"
                    />
                </div>
            </div>

            <div>
                <label className="text-sm font-medium">Catatan</label>
                <textarea
                    name="note"
                    value={form.note}
                    onChange={handleChange}
                    className="w-full border px-3 py-2 rounded-md"
                    rows="3"
                />
            </div>

            <div>
                <label className="text-sm font-medium">Upload Bukti DP (opsional)</label>
                <input
                    type="file"
                    accept="image/*"
                    onChange={(event) => setFile(event.target.files?.[0] ?? null)}
                    className="w-full"
                />
            </div>

            <button
                type="submit"
                disabled={submitting}
                className="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-md disabled:opacity-60"
            >
                {submitting ? 'Mengirim...' : 'Kirim Booking'}
            </button>
        </form>
    );
};

export default BookingForm;
