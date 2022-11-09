import React, { useState, useEffect } from 'react';
import Router, { useRouter, withRouter } from 'next/router'
import UserService from '../../../services/users'

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
