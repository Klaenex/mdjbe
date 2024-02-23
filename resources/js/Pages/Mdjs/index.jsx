import { useState, useEffect } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import Notification from "@/Components/Notification";

export default function Dashboard({ auth }) {
    const customizePaginationLabels = (link) => {
        let label = link.label.replace("&laquo;", "«").replace("&raquo;", "»");

        if (label.includes("Previous")) {
            return "Précédent";
        } else if (label.includes("Next")) {
            return "Suivant";
        }

        return label;
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Maisons de jeunes
                </h2>
            }
        >
            <Head title="Maisons de jeunes" />

            <section className="my-10 mx-7 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div className="flex justify-between items-center">
                    <h1 className="text-white py-5 text-xl font-semibold ">
                        Liste des maisons de jeunes
                    </h1>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
