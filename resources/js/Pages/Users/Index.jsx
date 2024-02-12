import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Dashboard({ auth, users }) {
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
                    Dashboard
                </h2>
            }
        >
            <Head title="Utilisateurs" />
            <section className="my-10 mx-7 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div className="flex justify-between items-center">
                    <h1 className="text-white py-5 text-xl font-semibold ">
                        Liste des utilisateurs
                    </h1>

                    <Link
                        className="p-2 border rounded block bg-green-400"
                        href={route("users.create")}
                    >
                        Ajouter un utilisateur
                    </Link>
                </div>

                <ul>
                    {users.data.map((user) => (
                        <li
                            className="text-white px-5 py-2 flex justify-between block w-full border-b border-gray-900"
                            key={user.id}
                        >
                            {user.name} - {user.email}{" "}
                            <button className="px-3 py-1 border rounded">
                                Modifier
                            </button>
                        </li>
                    ))}
                </ul>
                <nav aria-label="Pagination" className="py-5">
                    <ul className="flex list-style-none justify-center space-x-1">
                        {users.links.map((link, index) => {
                            const isActive = link.active;

                            const isPrevNext =
                                link.label.includes("Previous") ||
                                link.label.includes("Next");

                            const activeClasses = isActive
                                ? "bg-grey-500 text-white"
                                : "bg-grey-300 text-white-700";

                            const prevNextClasses = isPrevNext
                                ? "bg-grey-500 text-white"
                                : "";

                            const inactiveClasses =
                                !isActive && !isPrevNext
                                    ? "bg-gray-200 text-gray-800"
                                    : "";

                            const linkClasses = `px-3 py-1 border rounded ${activeClasses} ${prevNextClasses} ${inactiveClasses}`;

                            return (
                                <li key={index} className="py-2 px-2">
                                    <Link
                                        className={linkClasses}
                                        href={link.url ? link.url : "#"}
                                        preserveScroll
                                        disabled={!link.url}
                                    >
                                        {customizePaginationLabels(link)}
                                    </Link>
                                </li>
                            );
                        })}
                    </ul>
                </nav>
            </section>
        </AuthenticatedLayout>
    );
}
