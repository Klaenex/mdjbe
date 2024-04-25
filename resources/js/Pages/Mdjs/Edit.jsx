import { useState, useEffect } from "react";
import { Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import BaseMdj from "@/Components/partFormMdjs/BaseMdj";
import AdressMdj from "@/Components/partFormMdjs/AdressMdj";
import Notification from "@/Components/Notification";
import NetworksMdj from "@/Components/partFormMdjs/NetworksMdj";
import FilesInput from "@/Components/FilesInput";
import DpMdj from "@/Components/partFormMdjs/DpMdj";

import Modal from "@/Components/Modal";
import ProjetMdj from "@/Components/partFormMdjs/ProjetMdj";

export default function EditMdj({ auth, editMdj, dp, img, projetPorteur }) {
    // FORM DATA
    const { data, setData, post, errors, processing } = useForm({
        name: editMdj.name || "",
        tagline: editMdj.tagline || "",
        location: editMdj.location || "",
        objective: editMdj.objective || "",
        street: editMdj.street || "",
        number: editMdj.number || "",
        city: editMdj.city || "",
        tel: editMdj.tel || "",
        postal_code: editMdj.postal_code || "",
        email: editMdj.email || "",
        site: editMdj.site || "",
        facebook: editMdj.facebook || "",
        instagram: editMdj.instagram || "",
        logo: null,
        image1: null,
        image2: null,
        dispositif_particulier: editMdj.dispositif_particulier || "",
        projects: [],
    });
    console.log(projetPorteur);
    //NOTIFICATION
    const [notification, setNotification] = useState({
        show: false,
        message: "",
        type: "success",
    });
    useEffect(() => {
        const messageType = auth.flash.success ? "success" : "error";
        const messageContent =
            auth.flash.success ||
            auth.flash.error ||
            (errors &&
                Object.keys(errors).length > 0 &&
                errors[Object.keys(errors)[0]]);

        if (messageContent) {
            setNotification({
                show: true,
                message: messageContent,
                type: messageType,
            });
        }
    }, [auth.flash, errors]);

    // FORM LOGIC
    const onChange = (e) => {
        const { name, value } = e.target;
        setData((prevData) => ({
            ...prevData,
            [name]: value === "none" ? "" : value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/mdjs/${editMdj.id}/edit`, data, {
            forceFormData: true,
            _method: "put",
        });
        console.log(data);
    };

    //MODAL
    const [isModalOpen, setIsModalOpen] = useState(false);
    const handleOpen = () => setIsModalOpen(true);
    const handleClose = () => setIsModalOpen(false);

    //PROJET PORTEUR

    const addProject = (projectName) => {
        setData((data) => ({
            ...data,
            projects: Array.isArray(data.projects)
                ? [...data.projects, { name: projectName }]
                : [{ name: projectName }],
        }));
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
            <Notification
                show={notification.show}
                message={notification.message}
                type={notification.type}
                onClose={() =>
                    setNotification({ ...notification, show: false })
                }
            />
            <section className="my-10 mx-7 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form
                    onSubmit={handleSubmit}
                    className="flex flex-col gap-10"
                    encType="multipart/form-data"
                >
                    <BaseMdj data={data} onChange={onChange} errors={errors} />
                    <DpMdj
                        dp={dp}
                        selectedDispositif={editMdj.dispositif_particulier}
                        onChange={onChange}
                    />
                    <div className="text-white">
                        <h3>Projet porteur</h3>
                        <Modal show={isModalOpen} onClose={handleClose}>
                            <ProjetMdj
                                handleClose={handleClose}
                                addProject={addProject}
                            />
                        </Modal>
                        <ul className="mt-4 space-y-2">
                            {data.projects &&
                                data.projects.map((newProjet, index) => (
                                    <li className="text-green-300" key={index}>
                                        {newProjet.name}
                                    </li>
                                ))}
                            {projetPorteur &&
                                projetPorteur.map((projet, index) => (
                                    <li key={index}>{projet.name}</li>
                                ))}
                        </ul>
                        <button
                            type="button"
                            onClick={handleOpen}
                            className="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 transition duration-150 ease-in-out"
                        >
                            Ajouter un Projet Porteur
                        </button>
                    </div>
                    <FilesInput
                        htmlFor="logo"
                        label="Logo"
                        existingFileUrl={
                            img && img.find((i) => i.type === "logo")
                                ? `/storage/${
                                      img.find((i) => i.type === "logo").path
                                  }`
                                : null
                        }
                        onFileChange={(file) =>
                            setData({ ...data, logo: file })
                        }
                        img={img}
                        className="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <FilesInput
                        htmlFor="image1"
                        label="Image 1"
                        existingFileUrl={
                            img && img.find((i) => i.type === "image1")
                                ? `/storage/${
                                      img.find((i) => i.type === "image1").path
                                  }`
                                : null
                        }
                        onFileChange={(file) =>
                            setData({ ...data, image1: file })
                        }
                        img={img}
                        className="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    />

                    <FilesInput
                        htmlFor="image2"
                        label="Image 2"
                        existingFileUrl={
                            img && img.find((i) => i.type === "image2")
                                ? `/storage/${
                                      img.find((i) => i.type === "image2").path
                                  }`
                                : null
                        }
                        onFileChange={(file) =>
                            setData({ ...data, image2: file })
                        }
                        img={img}
                        className="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <AdressMdj
                        data={data}
                        onChange={onChange}
                        errors={errors}
                        img={img}
                    />
                    <NetworksMdj
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
