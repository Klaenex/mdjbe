import React, { useState, useEffect } from "react";
import { Head, router, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";
import TextArea from "@/Components/TextArea";
import PrimaryButton from "@/Components/PrimaryButton";
export default function EditMdj({
    auth,
    editMdj,
    dispositifsParticulier,
    img,
}) {
    const [formData, setFormData] = useState({
        name: editMdj.name,
        tagLine: editMdj.tagline,
        logo: editMdj.logo,
        location: editMdj.location,
        objective: editMdj.objective,
        street: editMdj.street,
        number: editMdj.number,
        city: editMdj.city,
        postal_code: editMdj.postal_code,
        tel: editMdj.tel,
        email: editMdj.email,
        site: editMdj.site,
        face: editMdj.facebook,
        instagram: editMdj.instagram,
        DP: {},
    });

    const [imagePreview, setImagePreview] = useState(
        editMdj.logo ? `URL_DE_VOTRE_SERVEUR/${editMdj.logo}` : null
    );

    useEffect(() => {
        setFormData({
            name: editMdj.name,
            tagLine: editMdj.tagline,
            logo: editMdj.logo,
            location: editMdj.location,
            objective: editMdj.objective,
        });
        setImagePreview(
            editMdj.logo ? `URL_DE_VOTRE_SERVEUR/${editMdj.logo}` : null
        );
    }, [editMdj]);

    const handleChange = (e) => {
        const { name, value, type, checked, files } = e.target;

        if (type === "file") {
            const file = files[0];
            setFormData({ ...formData, [name]: file });

            // Générer un aperçu de l'image
            const reader = new FileReader();
            reader.onloadend = () => {
                setImagePreview(reader.result);
            };
            reader.readAsDataURL(file);
        } else {
            setFormData({
                ...formData,
                [name]: type === "checkbox" ? checked : value,
            });
        }
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
                <form onSubmit={handleSubmit} className="flex flex-col gap-10">
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
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                            {imagePreview && (
                                <img
                                    src={imagePreview}
                                    alt="Aperçu du logo"
                                    className="mt-2"
                                    style={{ width: "100px", height: "100px" }}
                                />
                            )}
                        </div>
                    </div>
                    <div>
                        <div className="text-white">
                            <label htmlFor="location">
                                Situation et localisation
                            </label>
                            <TextArea
                                name="location"
                                type="text"
                                value={formData.location}
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                        </div>
                        <div className="text-white">
                            <label htmlFor="objective">
                                Principaux enjeux et objectif
                            </label>
                            <TextArea
                                name="objective"
                                type="text"
                                value={formData.objective}
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                        </div>
                    </div>
                    <div>
                        <div className="text-white flex flex-col gap-3">
                            <label htmlFor="dp-select">
                                Dispositif particulier
                            </label>
                            <select
                                name="DP"
                                id="dp-select"
                                className="text-black w-1/3 "
                            >
                                <option value="">Aucun</option>
                                {dispositifsParticulier.map((dP) => (
                                    <option key={dP.id}>{dP.name}</option>
                                ))}
                            </select>
                        </div>
                        <div className="text-white">
                            <label htmlFor="objective">Projets porteurs</label>
                            <ul></ul>

                            <PrimaryButton>Ajouter</PrimaryButton>
                        </div>
                    </div>

                    <div>
                        <div className="text-white">
                            <label htmlFor="photo">Photo</label>
                            <TextInput
                                name="photo"
                                type="file"
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                            {imagePreview && (
                                <img
                                    src={imagePreview}
                                    alt="Aperçu du logo"
                                    className="mt-2"
                                    style={{ width: "100px", height: "100px" }}
                                />
                            )}
                        </div>
                        <div className="text-white">
                            <label htmlFor="photo2">Photo2</label>
                            <TextInput
                                name="photo2"
                                type="file"
                                className="mt-1 block w-full"
                                onChange={handleChange}
                                required
                            />
                            {imagePreview && (
                                <img
                                    src={imagePreview}
                                    alt="Aperçu du logo"
                                    className="mt-2"
                                    style={{ width: "100px", height: "100px" }}
                                />
                            )}
                        </div>
                    </div>
                    <div className="text-white">
                        <h3 className="text-white text-2xl">
                            Adresse et contact
                        </h3>
                        <div>
                            <div>
                                <label htmlFor="rue">Rue</label>
                                <TextInput
                                    name="rue"
                                    type="text"
                                    value={formData.street}
                                    className="mt-1 block w-1/3"
                                    onChange={handleChange}
                                    required
                                />
                            </div>
                            <div>
                                <label htmlFor="N">N°</label>
                                <TextInput />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label htmlFor="ville">Ville</label>
                                <TextInput />
                            </div>
                            <div>
                                <label htmlFor="codepostal">Code postal</label>
                                <TextInput />
                            </div>
                        </div>
                        <div>
                            <label htmlFor="tel">Téléphone</label>
                            <TextInput />
                        </div>
                        <div>
                            <label htmlFor="email">Email</label>
                            <TextInput />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label htmlFor="web">Site web</label>
                            <TextInput />
                        </div>
                        <div>
                            <label htmlFor="face">Facebook</label>
                            <TextInput />
                        </div>
                        <div>
                            <label htmlFor="email">Instagram</label>
                            <TextInput />
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
