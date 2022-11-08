import React, { useState, useEffect } from 'react';
import ReactPaginate from 'react-paginate';
import Router, { useRouter, withRouter } from 'next/router'
import CarService from '../../services/cars'

import styles from '../../../styles/Cars.module.css'
import Head from '../../components/Head'
import Header from '../../components/Header'
import Swal from 'sweetalert2'

const Cars = (props) => {
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

    function deleteCar(id) {
        Swal.fire({
            title: "Remover?",
            text: "Deseja realmente remover esse carro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, remova!",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then(async (result) => {
            if (result.isConfirmed) {
                const carDeleted = await CarService.delete(id)

                if (carDeleted.status !== 204) {
                    Swal.fire(
                        'Erro!',
                        result.message,
                        "error"
                    )
                } else {
                    Swal.fire(
                        'Excluído!',
                        'Carro removido com sucesso',
                        "success"
                    ).then(() => {
                        router.push('/cars')
                    })
                }
            }
        })
    }

    const pagginationHandler = (page) => {
        const currentPath = props.router.pathname;
        const currentQuery = props.router.query;
        currentQuery.page = page.selected + 1;

        props.router.push({
            pathname: currentPath,
            query: currentQuery,
        });
    };

    let content = null;

    if (isLoading)
        content = <tr><td colSpan="2">Carregando...</td></tr>;
    else {
        content = (
            <>
                {props.cars.map(user => {
                    return (
                        <tr key={user.id}>
                            <td>{user.name}</td>
                            <td>
                                <a href={`/cars/edit/${encodeURIComponent(user.id)}`} className={styles.btnEdit}>Editar</a>
                                <button onClick={(e) => deleteCar(user.id)} className={styles.btnDelete}>Excluir</button>
                            </td>
                        </tr>
                    )
                })}
            </>
        );
    }

    return (
        <div className={styles.container}>
            <Head title="Carros - Projeto NextJS"></Head>

            <div className={styles.grid}>
                <a href="/" className={styles.back}>
                    <h2>&larr; Voltar</h2>
                </a>
            </div>

            <main className={styles.main}>
                <Header title="Lista de Carros"></Header>

                <a href='/cars/create' className={styles.btnSuccess}>Criar Carro</a>

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

                    <ReactPaginate
                        previousLabel={'Anterior'}
                        nextLabel={'Próximo'}
                        breakLabel={'...'}
                        activeClassName={styles.active}
                        containerClassName={styles.pagination}
                        subContainerClassName={'pages pagination'}

                        initialPage={props.currentPage - 1}
                        pageCount={props.pageCount}
                        marginPagesDisplayed={2}
                        pageRangeDisplayed={5}
                        onPageChange={pagginationHandler}
                    />
                </div>
            </main>
        </div>
    );
};

Cars.getInitialProps = async ({ query }) => {
    const page = query.page || 1;
    const response = await CarService.paginate(page);
    const cars = response.data

    return {
        totalCount: cars.meta.total,
        pageCount: cars.meta.from,
        currentPage: cars.meta.current_page,
        perPage: cars.meta.per_page,
        cars: cars.data,
    };
}

export default withRouter(Cars);