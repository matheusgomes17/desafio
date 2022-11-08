import Head from 'next/head'
import styles from '../../styles/Home.module.css'

export default function Home() {
  return (
    <div className={styles.container}>
      <Head>
        <title>Início - Projeto NextJS</title>
        <meta name="description" content="Essa é uma aplicação criada para o desafio da vaga de emprego na empresa XXXX" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main className={styles.main}>
        <h1 className={styles.title}>
          Seja bem vindo
        </h1>

        <p className={styles.description}>
          O que você gostaria de fazer?
        </p>

        <div className={styles.grid}>
          <a href="users" className={styles.card}>
            <h2>Gerenciamento de Usuários &rarr;</h2>
          </a>

          <a href="cars" className={styles.card}>
            <h2>Gerenciamento de Carros &rarr;</h2>
          </a>
        </div>
      </main>
    </div>
  )
}
