import { Head, Link } from "@inertiajs/react";

export default function Show({ mdj }) {
    return (
        <>
            <Head title={mdj.name} />
            <div className="max-w-3xl mx-auto py-12">
                <h1 className="text-3xl font-bold mb-4">{mdj.name}</h1>
                <p className="text-gray-700">
                    <strong>Ville&nbsp;:</strong> {mdj.city ?? "—"}
                </p>
                <p className="text-gray-700">
                    <strong>Région&nbsp;:</strong> {mdj.region ?? "—"}
                </p>

                <div className="mt-6">
                    <Link
                        href={route("mdjs.index")}
                        className="text-red-600 hover:underline"
                    >
                        ← Retour à la liste
                    </Link>
                </div>
            </div>
        </>
    );
}
