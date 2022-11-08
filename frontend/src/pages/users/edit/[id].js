import FormUpdate from "../../../components/users/FormUpdate"
import UserService from "../../../services/users"

export default function EditUser(props) {
    return (
        <div>
            <FormUpdate dataUser={props.data}></FormUpdate>
        </div>
    )
}

export async function getServerSideProps(context) {
    const { id } = context.query

    if (id) {
        const response = await UserService.findById(id)
        const data = response.data

        if (!data) {
            return {
                notFound: true,
            }
        }

        return {
            props: { data },
        }
    }
}
