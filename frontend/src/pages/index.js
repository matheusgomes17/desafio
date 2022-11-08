import Head from 'next/head'
import Image from 'next/image'
import styles from '../../styles/Home.module.css'

export default function Home() {
  return (
    <div className={styles.container}>
      <Head>
        <title>Desafio - Projeto NextJS</title>
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
          <a href="#" className={styles.card}>
            <h2>Gerenciamento de Usuários &rarr;</h2>
          </a>

          <a href="#" className={styles.card}>
            <h2>Gerenciamento de Carros &rarr;</h2>
          </a>
        </div>
      </main>
    </div>
  )
}
