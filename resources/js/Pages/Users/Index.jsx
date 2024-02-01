import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import { Head, Link } from "@inertiajs/react";

export default function Dashboard({ auth, users }) {
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

            <h1>Liste des utilisateurs</h1>
            <ul>
                {users.data.map((user) => (
                    <li key={user.id}>
                        {user.name} - {user.email}
                    </li>
                ))}
            </ul>
            <nav>
                <ul>
                    <li>
                        {users.links.map((link, index) => (
                            <Link
                                className="text-white px-2"
                                key={index}
                                href={link.url}
                                disabled={!link.url}
                                preserveScroll
                            >
                                {link.label}
                            </Link>
                        ))}
                    </li>
                </ul>
            </nav>
        </AuthenticatedLayout>
    );
}
