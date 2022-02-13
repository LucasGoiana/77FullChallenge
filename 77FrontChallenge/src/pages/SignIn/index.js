import React, { Component } from "react";
import { Link, withRouter } from "react-router-dom";

import Logo from "../../assets/images/logo.588a3bb9.png";
import api from "../../services/api";
import { Form, Container } from "./style";
import { login } from "../../services/auth";



class SignIn extends Component {
    state = {
        email: "",
        password: "",
        error: ""
    };

    handleSignIn = async e => {
        e.preventDefault();
        const { email, password } = this.state;
        if (!email || !password) {
            this.setState({ error: "Preencha e-mail e senha para continuar!" });
        } else {
            try {
                const response = await api.post("/api/login", { email, password });
                login(response.data.token);
                this.props.history.push("/app");
            } catch (err) {
                if(err.response.status == 401){
                    this.setState({ error: err.response.data.mensagem });
                }

                this.setState({
                    error:
                        "Usuário ou Senha Incorretos!"
                });
            }
        }
    };

    render() {
        return (
            <Container>
                <Form onSubmit={this.handleSignIn}>
                    <img src={Logo} alt="77Sol logo" />
                    {this.state.error && <p>{this.state.error}</p>}
                    <input
                        type="email"
                        placeholder="Endereço de e-mail"
                        onChange={e => this.setState({ email: e.target.value })}
                    />
                    <input
                        type="password"
                        placeholder="Senha"
                        onChange={e => this.setState({ password: e.target.value })}
                    />
                    <button type="submit">Entrar</button>
                    <hr />
                    Desenvolvimento por <strong> <a target={"_blank"} href={"https://lucasgoiana.com/"}>Lucas Goiana Malicia</a></strong>
                </Form>
            </Container>
        );
    }
}

export default withRouter(SignIn);