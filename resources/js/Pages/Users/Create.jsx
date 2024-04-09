import { useState, useEffect } from "react";
import { router, Head } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";

import PrimaryButton from "@/Components/PrimaryButton";
import Notification from "@/Components/Notification";
export default function CreateUser({ auth, errors }) {
    const [notification, setNotification] = useState({
        show: false,
        message: "",
        type: "success",
    });
    useEffect(() => {
        if (auth.flash.success) {
            setNotification({
                show: true,
                message: auth.flash.success,
                type: "success",
            });
        } else if (auth.flash.error) {
            setNotification({
                show: true,
                message: auth.flash.error,
                type: "error",
            });
        }
    }, [auth.flash.success, auth.flash.error]);
    useEffect(() => {
        if (errors.email) {
            setNotification({
                show: true,
                message: errors.email,
                type: "error",
            });
        }
    }, [errors.email]);

    const [formData, setFormData] = useState({
        name: "",
        email: "",
        mj: "",
        is_admin: 0,
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
        router.post("create", formData);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Créer un nouvel utilisateur
                </h2>
            }
        >
            <Head title="Création d'utilisateurs" />
            <Notification
                show={notification.show}
                message={notification.message}
                type={notification.type}
                onClose={() =>
                    setNotification({ ...notification, show: false })
                }
            />
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
                    <div className="text-white mt-4">
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
                    <div className="text-white mt-4">
                        <label htmlFor="mj">Nom de la Mj</label>
                        <TextInput
                            name="mj"
                            type="text"
                            value={formData.mj}
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
                        <PrimaryButton>Créer utilisateur</PrimaryButton>
                    </div>
                </form>
            </section>
        </AuthenticatedLayout>
    );
}
