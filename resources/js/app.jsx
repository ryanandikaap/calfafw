import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { AuthProvider } from './contexts/AuthContext';
import Layout from './components/Layout';
import About from './pages/About';
import Admin from './pages/Admin';
import AdminTreatments from './pages/admin/Treatments';
import Home from './pages/Home';
import Kursus from './pages/Kursus';
import Login from './pages/Login';
import Register from './pages/Register';
import News from './pages/News';
import NewsDetail from './pages/NewsDetail';
import NotFound from './pages/NotFound';
import Treatment from './pages/Treatment';

const App = () => (
    <BrowserRouter>
        <AuthProvider>
            <Routes>
                <Route element={<Layout />}>
                    <Route index element={<Home />} />
                    <Route path="about" element={<About />} />
                    <Route path="treatment" element={<Treatment />} />
                    <Route path="kursus" element={<Kursus />} />
                    <Route path="news" element={<News />} />
                    <Route path="news/:id" element={<NewsDetail />} />
                    <Route path="admin" element={<Admin />} />
                    <Route path="admin/treatments" element={<AdminTreatments />} />
                </Route>
                <Route path="login" element={<Login />} />
                <Route path="register" element={<Register />} />
                <Route path="*" element={<NotFound />} />
            </Routes>
        </AuthProvider>
    </BrowserRouter>
);

// Render the React app
const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);

export default App;
