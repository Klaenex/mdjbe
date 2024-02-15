import { useEffect, useState } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm, router } from "@inertiajs/react";

export default function Register() {
    const [token, setToken] = useState("");
    const [userId, setUserId] = useState("");
    const { data, setData, put, processing, errors, reset } = useForm({
        password: "",
        password_confirmation: "",
    });

    useEffect(() => {
        const searchParams = new URLSearchParams(window.location.search);
        const tokenParam = searchParams.get("token");
        const userIdParam = searchParams.get("userId");

        if (tokenParam && userIdParam) {
            setToken(tokenParam);
            setUserId(userIdParam);
        }
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const url = route("register.update", { userId: userId, token: token });
    const submit = (e) => {
        e.preventDefault();
        console.log(data);
        router.put(url, data);
    };

    return (
        <GuestLayout>
            <Head title="inscription" />
            <form onSubmit={submit}>
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData("password", e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Confirm Password"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                        required
                    />

                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <PrimaryButton className="ms-4" disabled={processing}>
                        S'enregistrer
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
