import React, { useState, useEffect } from 'react';
import Router, { useRouter, withRouter } from 'next/router'
import UserService from '../../../services/users'
import CarService from '../../../services/cars'

import styles from '../../../../styles/Users.module.css'
import Head from '../../../components/Head'
import Header from '../../../components/Header'
import Swal from 'sweetalert2'

export default function UserCars(props) {
    const router = useRouter()

    const [isLoading, setLoading] = useState(false)
    const startLoading = () => setLoading(true)
    const stopLoading = () => setLoading(false)

    useEffect(() => {
        Router.events.on('routeChangeStart', startLoading);
        Router.events.on('routeChangeComplete', stopLoading);

        return () => {
            Router.events.off('routeChangeStart', startLoading);
            Router.events.off('routeChangeComplete', stopLoading);
        }
    }, [])

    async function addCars(id) {
        const response = await CarService.all()
        const carsData = response.data
        const cars = carsData.data

        Swal.fire({
            title: "Selecione o carro do usuário",
            input: "select",
            inputOptions: cars,
            inputPlaceholder: 'Selecione um carro',
            showCancelButton: true,
            confirmButtonText: "Adicionar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then(async (result) => {
            if (result.isConfirmed) {
                const carAttached = await UserService.attachCar(id, [result.value])

                if (carAttached.status !== 200) {
                    Swal.fire(
                        'Erro!',
                        carAttached.data.message,
                        "error"
                    )
                } else {
                    Swal.fire(
                        'Excluído!',
                        carAttached.data.message,
                        "success"
                    ).then(() => {
                        router.push(`/users/${id}/cars`)
                    })
                }
            }
        })
    }

    let content = null;

    if (isLoading)
        content = <tr><td colSpan="2">Carregando...</td></tr>;
    else {
        content = (
            <>
                {props.data.cars && props.data.cars.map(car => {
                    return (
                        <tr key={car.id}>
                            <td>{car.name}</td>
                            <td></td>
                        </tr>
                    )
                })}
            </>
        );
    }

    return (
        <div className={styles.container}>
            <Head title="Carros do Usuário - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/users" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Lista de Carros do Usuário"></Header>
                
                <p className={styles.description}>
                    Gerencie a lista de carros do usuário <strong>{props.data.name}</strong>
                </p>

                <button onClick={(e) => addCars(props.data.id)} className={styles.btnSuccess}>Adicionar Carros</button>

                <div className={styles.grid}>
                    <table className={styles.table}>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {content}
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    );
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
