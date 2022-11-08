import FormUpdate from "../../../components/cars/FormUpdate"
import CarService from "../../../services/cars"

export default function EditCar(props) {
    return (
        <div>
            <FormUpdate dataCar={props.data}></FormUpdate>
        </div>
    )
}

export async function getServerSideProps(context) {
    const { id } = context.query

    if (id) {
        const response = await CarService.findById(id)
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
