import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../contexts/AuthContext';
import axios from 'axios';

const Treatments = () => {
    const { user, isAdmin, loading: authLoading } = useAuth();
    const navigate = useNavigate();
    const [treatments, setTreatments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showModal, setShowModal] = useState(false);
    const [editMode, setEditMode] = useState(false);
    const [currentTreatment, setCurrentTreatment] = useState(null);
    const [formData, setFormData] = useState({
        name: '',
        category: '',
        description: '',
        price: '',
        image: null,
    });
    const [imagePreview, setImagePreview] = useState(null);

    useEffect(() => {
        if (!authLoading && !isAdmin) {
            navigate('/');
        }
    }, [isAdmin, authLoading, navigate]);

    useEffect(() => {
        if (isAdmin) {
            fetchTreatments();
        }
    }, [isAdmin]);

    const fetchTreatments = async () => {
        try {
            const token = localStorage.getItem('token');
            const response = await axios.get('/api/admin/treatments', {
                headers: { Authorization: `Bearer ${token}` }
            });
            setTreatments(response.data);
        } catch (error) {
            console.error('Error fetching treatments:', error);
        } finally {
            setLoading(false);
        }
    };

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    const handleImageChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setFormData(prev => ({ ...prev, image: file }));
            setImagePreview(URL.createObjectURL(file));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        const token = localStorage.getItem('token');
        const data = new FormData();
        data.append('name', formData.name);
        data.append('category', formData.category);
        data.append('description', formData.description);
        data.append('price', formData.price);
        if (formData.image) {
            data.append('image', formData.image);
        }

        try {
            if (editMode) {
                await axios.post(`/api/admin/treatments/${currentTreatment.id}`, data, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        'Content-Type': 'multipart/form-data',
                    }
                });
            } else {
                await axios.post('/api/admin/treatments', data, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        'Content-Type': 'multipart/form-data',
                    }
                });
            }
            
            fetchTreatments();
            closeModal();
        } catch (error) {
            console.error('Error saving treatment:', error);
            alert('Error saving treatment');
        }
    };

    const handleEdit = (treatment) => {
        setCurrentTreatment(treatment);
        setFormData({
            name: treatment.name,
            category: treatment.category,
            description: treatment.description,
            price: treatment.price,
            image: null,
        });
        setImagePreview(treatment.image);
        setEditMode(true);
        setShowModal(true);
    };

    const handleDelete = async (id) => {
        if (!confirm('Are you sure you want to delete this treatment?')) return;

        try {
            const token = localStorage.getItem('token');
            await axios.delete(`/api/admin/treatments/${id}`, {
                headers: { Authorization: `Bearer ${token}` }
            });
            fetchTreatments();
        } catch (error) {
            console.error('Error deleting treatment:', error);
            alert('Error deleting treatment');
        }
    };

    const openModal = () => {
        setShowModal(true);
        setEditMode(false);
        setFormData({ name: '', category: '', description: '', price: '', image: null });
        setImagePreview(null);
        setCurrentTreatment(null);
    };

    const closeModal = () => {
        setShowModal(false);
        setEditMode(false);
        setFormData({ name: '', category: '', description: '', price: '', image: null });
        setImagePreview(null);
        setCurrentTreatment(null);
    };

    if (authLoading || loading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-gray-100">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-600 mx-auto"></div>
                    <p className="mt-4 text-gray-600">Loading...</p>
                </div>
            </div>
        );
    }

    if (!isAdmin) return null;

    return (
        <div className="min-h-screen bg-gray-100 pt-20">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="bg-white rounded-lg shadow-md p-6">
                    <div className="flex justify-between items-center mb-6">
                        <h1 className="text-3xl font-bold text-gray-900">Manage Treatments</h1>
                        <button
                            onClick={openModal}
                            className="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors"
                        >
                            Add New Treatment
                        </button>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {treatments.map((treatment) => (
                            <div key={treatment.id} className="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                {treatment.image && (
                                    <img
                                        src={treatment.image}
                                        alt={treatment.name}
                                        className="w-full h-48 object-cover"
                                    />
                                )}
                                <div className="p-4">
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">{treatment.name}</h3>
                                    <p className="text-gray-600 text-sm mb-3 line-clamp-2">{treatment.description}</p>
                                    <p className="text-pink-600 font-bold text-lg mb-4">Rp {parseInt(treatment.price).toLocaleString('id-ID')}</p>
                                    <div className="flex gap-2">
                                        <button
                                            onClick={() => handleEdit(treatment)}
                                            className="flex-1 bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition-colors text-sm"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            onClick={() => handleDelete(treatment.id)}
                                            className="flex-1 bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition-colors text-sm"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {treatments.length === 0 && (
                        <div className="text-center py-12">
                            <p className="text-gray-500">No treatments found. Add your first treatment!</p>
                        </div>
                    )}
                </div>
            </div>

            {/* Modal */}
            {showModal && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                    <div className="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                        <div className="p-6">
                            <h2 className="text-2xl font-bold text-gray-900 mb-4">
                                {editMode ? 'Edit Treatment' : 'Add New Treatment'}
                            </h2>
                            <form onSubmit={handleSubmit}>
                                <div className="mb-4">
                                    <label className="block text-gray-700 font-semibold mb-2">Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        value={formData.name}
                                        onChange={handleInputChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-600"
                                        required
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 font-semibold mb-2">Category</label>
                                    <select
                                        name="category"
                                        value={formData.category}
                                        onChange={handleInputChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-600"
                                        required
                                    >
                                        <option value="">Select Category</option>
                                        <option value="Hair Treatment">Hair Treatment</option>
                                        <option value="Facial Treatment">Facial Treatment</option>
                                        <option value="Body Treatment">Body Treatment</option>
                                        <option value="Nail Treatment">Nail Treatment</option>
                                        <option value="Makeup">Makeup</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 font-semibold mb-2">Description</label>
                                    <textarea
                                        name="description"
                                        value={formData.description}
                                        onChange={handleInputChange}
                                        rows="4"
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-600"
                                        required
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 font-semibold mb-2">Price (Rp)</label>
                                    <input
                                        type="number"
                                        name="price"
                                        value={formData.price}
                                        onChange={handleInputChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-600"
                                        required
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 font-semibold mb-2">Image</label>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        onChange={handleImageChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-600"
                                    />
                                    {imagePreview && (
                                        <img
                                            src={imagePreview}
                                            alt="Preview"
                                            className="mt-4 w-full h-48 object-cover rounded-lg"
                                        />
                                    )}
                                </div>
                                <div className="flex gap-4">
                                    <button
                                        type="submit"
                                        className="flex-1 bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors"
                                    >
                                        {editMode ? 'Update' : 'Create'}
                                    </button>
                                    <button
                                        type="button"
                                        onClick={closeModal}
                                        className="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Treatments;
