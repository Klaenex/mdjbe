import { useState, useEffect } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import Notification from "@/Components/Notification";

export default function Dashboard({ auth, mdjs }) {
    const [notification, setNotification] = useState({
        show: false,
        message: "",
        type: "success",
    });

    useEffect(() => {
        if (auth.flash.success) {
            setNotification({ show: true, message: auth.flash.success });
        } else if (auth.flash.error) {
            setNotification({ show: true, message: auth.flash.success });
        }
    }, [auth.flash]);

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
                <ul>
                    {mdjs.data.map((mdj) => (
                        <li
                            className="text-white px-5 py-2 flex justify-between w-full border-b border-gray-900"
                            key={mdj.id}
                        >
                            {mdj.name}
                            <Link
                                href={route("mdjs.edit", { id: mdj.id })}
                                className="px-3 py-1 border rounded"
                            >
                                Modifier
                            </Link>
                        </li>
                    ))}
                </ul>
            </section>
        </AuthenticatedLayout>
    );
}
