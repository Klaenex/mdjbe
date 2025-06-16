import { Head, Link } from "@inertiajs/react";

export default function Index({ mdjs }) {
    return (
        <>
            <Head title="Maisons de jeunes" />
            <div className="max-w-4xl mx-auto py-12">
                <h1 className="text-3xl font-bold mb-6">
                    Liste des maisons de jeunes
                </h1>

                <ul className="divide-y divide-gray-300">
                    {mdjs.data.map((item) => (
                        <li key={item.id} className="py-3 flex justify-between">
                            <span>
                                <span className="font-semibold">{item.name}</span>
                                <span className="text-gray-600">
                                    {" "}
                                    — {item.city} ({item.region})
                                </span>
                            </span>

                            <Link
                                href={route("mdjs.show", { id: item.id })}
                                className="text-red-600 hover:underline"
                            >
                                Voir
                            </Link>
                        </li>
                    ))}
                </ul>

                <div className="mt-8">
                    {mdjs.links.map((link) =>
                        link.url ? (
                            <Link
                                key={link.label}
                                href={link.url}
                                preserveScroll
                                className={
                                    "px-3 py-1 border rounded mx-1 " +
                                    (link.active ? "bg-red-600 text-white" : "")
                                }
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ) : null
                    )}
                </div>
            </div>
        </>
    );
}
