// js/Pages/Users/Create.jsx

import React, { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
import { Inertia } from "@inertiajs/inertia";

export default function CreateUser(props) {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        is_admin: false,
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
        Inertia.post("/users", formData);
    };

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Créer un nouvel utilisateur
                </h2>
            }
        >
            <form onSubmit={handleSubmit}>
                <div>
                    <TextInput
                        name="name"
                        type="text"
                        value={formData.name}
                        className="mt-1 block w-full"
                        handleChange={handleChange}
                        required
                    />
                </div>
                <div className="mt-4">
                    <TextInput
                        name="email"
                        type="email"
                        value={formData.email}
                        className="mt-1 block w-full"
                        handleChange={handleChange}
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
                    <PrimaryButton>Créer utilisateur</PrimaryButton>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
