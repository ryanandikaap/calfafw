import React, { useState } from 'react';
import { NavLink, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';

const navItems = [
    { to: '/', label: 'Home' },
    { to: '/treatment', label: 'Treatment' },
    { to: '/kursus', label: 'Kursus' },
    { to: '/about', label: 'About' },
    { to: '/news', label: 'News' },
];

const linkClass = ({ isActive }) =>
    `text-xs uppercase tracking-widest ${isActive ? 'text-pink-500' : 'text-white hover:text-gray-300'}`;

const Navbar = () => {
    const [open, setOpen] = useState(false);
    const { user, logout, isAdmin } = useAuth();

    const handleLogout = async () => {
        await logout();
        setOpen(false);
    };

    return (
        <header className="fixed top-0 left-0 w-full bg-black z-30">
            <div className="flex items-center justify-between px-6 py-4">
                <NavLink to="/" className="flex items-center gap-3">
                    <img src="/images/new.png" alt="Calfa Hair & Beauty" className="h-9 md:h-10" />
                </NavLink>

                <nav className="hidden md:flex flex-1 justify-center space-x-10">
                    {navItems.map((item) => (
                        <NavLink key={item.to} to={item.to} className={linkClass} end>
                            {item.label}
                        </NavLink>
                    ))}
                    {isAdmin && (
                        <NavLink to="/admin" className={linkClass}>
                            Admin
                        </NavLink>
                    )}
                </nav>

                <div className="hidden md:flex items-center gap-3">
                    {user ? (
                        <>
                            <span className="text-white text-xs">
                                Hi, {user.name}
                            </span>
                            <button
                                onClick={handleLogout}
                                className="bg-gray-700 hover:bg-gray-600 text-white text-xs px-4 py-2 rounded-md"
                            >
                                LOGOUT
                            </button>
                        </>
                    ) : (
                        <Link
                            to="/login"
                            className="bg-gray-700 hover:bg-gray-600 text-white text-xs px-4 py-2 rounded-md"
                        >
                            LOGIN
                        </Link>
                    )}
                    <a
                        href="https://wa.me/6282224422295"
                        target="_blank"
                        rel="noreferrer"
                        className="bg-pink-600 hover:bg-pink-700 text-white text-xs px-4 py-2 rounded-md"
                    >
                        CONTACT
                    </a>
                </div>

                <div className="flex md:hidden items-center gap-3">
                    <button
                        type="button"
                        className="text-white"
                        onClick={() => setOpen((prev) => !prev)}
                        aria-label="Toggle menu"
                    >
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {open ? (
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                            ) : (
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
                            )}
                        </svg>
                    </button>
                </div>
            </div>

            <div
                className={`md:hidden bg-black text-white flex flex-col items-center space-y-4 overflow-hidden transition-all duration-300 ${
                    open ? 'max-h-screen py-4 opacity-100' : 'max-h-0 opacity-0'
                }`}
            >
                {navItems.map((item) => (
                    <NavLink
                        key={item.to}
                        to={item.to}
                        className={({ isActive }) => (isActive ? 'text-pink-500' : 'text-white')}
                        onClick={() => setOpen(false)}
                        end
                    >
                        {item.label}
                    </NavLink>
                ))}
                {isAdmin && (
                    <NavLink
                        to="/admin"
                        className={({ isActive }) => (isActive ? 'text-pink-500' : 'text-white')}
                        onClick={() => setOpen(false)}
                    >
                        Admin
                    </NavLink>
                )}
                {user ? (
                    <>
                        <span className="text-gray-400 text-xs">Hi, {user.name}</span>
                        <button
                            onClick={handleLogout}
                            className="text-white hover:text-pink-500"
                        >
                            Logout
                        </button>
                    </>
                ) : (
                    <Link
                        to="/login"
                        className="text-white hover:text-pink-500"
                        onClick={() => setOpen(false)}
                    >
                        Login
                    </Link>
                )}
                <a
                    href="https://wa.me/6282224422295"
                    target="_blank"
                    rel="noreferrer"
                    className="bg-pink-600 hover:bg-pink-700 text-white text-xs px-4 py-2 rounded-md"
                >
                    CONTACT
                </a>
            </div>
        </header>
    );
};

export default Navbar;
