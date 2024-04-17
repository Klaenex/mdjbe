import TextInput from "../TextInput";

export default function NetworksMdj({ data, onChange }) {
    return (
        <div>
            <div className="text-white">
                <label htmlFor="email">Email</label>
                <TextInput
                    name="email"
                    type="email"
                    value={data.email}
                    className="mt-1 block w-1/3"
                    onChange={onChange}
                />
            </div>

            <div className="text-white">
                <label htmlFor="site">Site web</label>
                <TextInput
                    name="site"
                    type="text"
                    value={data.site}
                    className="mt-1 block w-1/3"
                    onChange={onChange}
                />
            </div>
            <div className="text-white">
                <label htmlFor="facebook">Facebook</label>
                <TextInput
                    name="facebook"
                    type="text"
                    value={data.facebook}
                    className="mt-1 block w-1/3"
                    onChange={onChange}
                />
            </div>
            <div className="text-white">
                <label htmlFor="instagram">Instagram</label>
                <TextInput
                    name="instagram"
                    type="text"
                    value={data.instagram}
                    className="mt-1 block w-1/3"
                    onChange={onChange}
                />
            </div>
        </div>
    );
}
