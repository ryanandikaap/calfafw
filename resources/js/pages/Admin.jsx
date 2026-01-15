import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';

const Admin = () => {
    const { user, isAdmin, loading } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (!loading && !isAdmin) {
            navigate('/');
        }
    }, [isAdmin, loading, navigate]);

    if (loading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-gray-100">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-600 mx-auto"></div>
                    <p className="mt-4 text-gray-600">Loading...</p>
                </div>
            </div>
        );
    }

    if (!isAdmin) {
        return null;
    }

    return (
        <div className="min-h-screen bg-gray-100 pt-20">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="bg-white rounded-lg shadow-md p-6">
                    <h1 className="text-3xl font-bold text-gray-900 mb-6">
                        Admin Dashboard
                    </h1>
                    
                    <div className="mb-6">
                        <p className="text-gray-600">
                            Welcome, <span className="font-semibold text-gray-900">{user?.name}</span>
                        </p>
                        <p className="text-sm text-gray-500 mt-1">
                            Email: {user?.email}
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a
                            href="/admin/treatments"
                            className="block p-6 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        Manage Treatments
                                    </h3>
                                    <p className="text-pink-100 text-sm">
                                        Add, edit, or delete treatments
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="/legacy/admin/kelola_news.php"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="block p-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        Manage News
                                    </h3>
                                    <p className="text-purple-100 text-sm">
                                        Add, edit, or delete news articles
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="/legacy/admin/slider.php"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="block p-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        Manage Sliders
                                    </h3>
                                    <p className="text-blue-100 text-sm">
                                        Add, edit, or delete slider images
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="/legacy/admin/tambah_hairstylist.php"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="block p-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        Manage Hairstylists
                                    </h3>
                                    <p className="text-green-100 text-sm">
                                        Add, edit, or delete hairstylists
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="/legacy/admin/booking_treatment.php"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="block p-6 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        View Bookings
                                    </h3>
                                    <p className="text-yellow-100 text-sm">
                                        View and manage treatment bookings
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="/legacy/admin/dashboard.php"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="block p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <h3 className="text-white text-lg font-semibold mb-2">
                                        Legacy Dashboard
                                    </h3>
                                    <p className="text-indigo-100 text-sm">
                                        Access old admin dashboard
                                    </p>
                                </div>
                                <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div className="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div className="flex items-start">
                            <svg className="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 className="text-sm font-semibold text-blue-900 mb-1">
                                    Note
                                </h4>
                                <p className="text-sm text-blue-700">
                                    These links will open the legacy PHP admin pages in a new tab. Make sure you're logged in to the legacy system as well.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Admin;
