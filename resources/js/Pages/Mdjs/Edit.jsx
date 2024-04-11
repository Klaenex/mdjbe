import React from "react";
import { Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import BaseMdj from "@/Components/partFormMdjs/BaseMdj";
import AdressMdj from "@/Components/partFormMdjs/AdressMdj";

export default function EditMdj({ auth, editMdj, dispositifsParticulier }) {
    const { data, setData, put, errors, processing } = useForm({
        name: editMdj.name || "",
        tagline: editMdj.tagline || "",
        location: editMdj.location || "",
        objective: editMdj.objective || "",
        street: editMdj.street || "",
        number: editMdj.number || "",
        city: editMdj.city || "",
        tel: editMdj.tel || "",
        // Ajoutez d'autres champs si nécessaire
    });

    const onChange = (e) => {
        const { name, value, type, checked } = e.target;

        setData((data) => ({
            ...data,
            [name]: type === "checkbox" ? checked : value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(data);
        put(`/mdjs/${editMdj.id}/edit`);
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
                <form onSubmit={handleSubmit} className="flex flex-col gap-10">
                    <BaseMdj data={data} onChange={onChange} errors={errors} />
                    <AdressMdj
                        data={data}
                        onChange={onChange}
                        errors={errors}
                    />
                    <div className="mt-4">
                        <PrimaryButton disabled={processing}>
                            Modifier la maison de jeune
                        </PrimaryButton>
                    </div>
                </form>
            </section>
        </AuthenticatedLayout>
    );
}
