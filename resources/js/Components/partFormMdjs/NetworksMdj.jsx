import TextInput from "../TextInput";

export default function NetworksMdj() {
    return (
        <div>
            <div>
                <label htmlFor="email">Email</label>
                <TextInput />
            </div>

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
    );
}
