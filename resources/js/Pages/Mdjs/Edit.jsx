import React, { useState } from "react";
import { Head, router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
export default function EditMdj({ auth, editMdj }) {
    const [formData, setFormData] = useState({
        name: editMdj.name,
        tagLine: editMdj.tagline,
        logo: editMdj.logo,
        location: editMdj.location,
        objective: editMdj.objective,
    });

    console.log(editMdj);
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
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Modifier une maison de jeune
                </h2>
            }
        >
            <Head title="Modification une maison de jeune" />

            <section className="my-10 mx-7 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form onSubmit={handleSubmit}>
                    <div>
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
                        <div className="text-white">
                            <label htmlFor="tagLine">Phrase d'accroche</label>
                            <TextInput
                                name="tagLine"
                                type="text"
                                value={formData.tagLine}
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                        </div>
                        <div className="text-white">
                            <label htmlFor="logo">Logo</label>
                            <TextInput
                                name="logo"
                                type="file"
                                value={formData.logo}
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                            {progress && (
                                <progress
                                    id="logo"
                                    value={progress.percentage}
                                    max="100"
                                >
                                    {progress.percentage}%
                                </progress>
                            )}
                        </div>
                    </div>

                    <div className="mt-4">
                        <PrimaryButton>
                            Modifier la maison de jeune
                        </PrimaryButton>
                    </div>
                </form>
            </section>
        </AuthenticatedLayout>
    );
}
