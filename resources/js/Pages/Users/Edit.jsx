import React, { useState } from "react";
import { Head, router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";

export default function EditUser({ auth, editUser }) {
    const [formData, setFormData] = useState({
        name: editUser.name,
        email: editUser.email,
        is_admin: editUser.is_admin,
    });
    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData({
            ...formData,
            [name]: type === "checkbox" ? checked : value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(formData);
        router.put("edit", formData);
    };
    const handleDelete = () => {
        if (
            window.confirm(
                "Êtes-vous sûr de vouloir supprimer cet utilisateur ?"
            )
        ) {
            router.delete(`/users/${editUser.id}`);
        }
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Modifier un utilisateur
                </h2>
            }
        >
            <Head title="Modification utilisateurs" />

            <section className="my-10 mx-7 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form onSubmit={handleSubmit}>
                    <div className="text-white">
                        <label htmlFor="name">Nom</label>
                        <TextInput
                            name="name"
                            type="text"
                            value={formData.name}
                            className="mt-1 block w-full"
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mt-4 text-white">
                        <label htmlFor="email">Email</label>
                        <TextInput
                            name="email"
                            type="email"
                            value={formData.email}
                            className="mt-1 block w-full"
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mt-4">
                        <label className="flex items-center">
                            <input
                                type="checkbox"
                                name="is_admin"
                                checked={formData.is_admin}
                                onChange={handleChange}
                            />
                            <span className="ml-2 text-sm text-gray-600">
                                Administrateur
                            </span>
                        </label>
                    </div>
                    <div className="mt-4">
                        <PrimaryButton>Modifier l'utilisateur</PrimaryButton>
                    </div>
                    <div className="mt-4">
                        <button
                            type="button"
                            onClick={handleDelete}
                            className="bg-red-500 hover:bg-red-700 text-white inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 transition ease-in-out duration-150 undefined "
                        >
                            Supprimer l'utilisateur
                        </button>
                    </div>
                </form>
            </section>
        </AuthenticatedLayout>
    );
}
