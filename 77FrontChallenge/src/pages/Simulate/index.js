import React, { Component } from "react";
import { Link, withRouter } from "react-router-dom";
import InputMask from "react-input-mask";
import { Form, Container } from "./styles";
import api from "../../services/api";
import Logo from "../../assets/images/logo.588a3bb9.png";

class Simulate extends Component {
    state = {
        cep: "",
        valor_conta: "",
        estrutura: "",
        error: "",
        button:"Simular"
    };

    handleSignUp = async e => {
        e.preventDefault();
        const { cep, valor_conta, estrutura } = this.state;
        if (!cep || !valor_conta || !estrutura) {
            this.setState({ error: "Preencha todos os dados para se cadastrar" });
            this.setState({ button: "Simular" })
        } else {
            try {

               let response =  await api.post("/api/simulate", { cep, valor_conta, estrutura });
               console.log(response.data.economia);
                this.props.history.push({
                    pathname: '/result',
                    economia: response.data.economia,
                    potencial: response.data.potencial,
                    parcelamento: response.data.parcelamento,

                });
            } catch (err) {
                if(err.response.status == 500){
                    this.setState({ error: err.response.data.mensagem });
                }
                if(err.response.status == 400){
                    this.props.history.push({
                        pathname: '/'});
                }
                this.setState({ button: "Simular" })


            }
        }
    };

    render() {
        return (
            <Container>
                <Form onSubmit={this.handleSignUp}>
                    <img src={Logo} alt="77Sol logo" />

                    {this.state.error && <p>{this.state.error}</p>}
                    <InputMask
                        className={"cep"}
                        mask="99999-999"
                        type="text"
                        placeholder="CEP"
                        onChange={e => this.setState({ cep: e.target.value })}
                    />

                    <input
                        type="text"
                        placeholder="Valor da Conta"
                        onChange={e => this.setState({ valor_conta: e.target.value })}
                    />
                    <input
                        type="text"
                        placeholder="Tipo de Telhado"
                        onChange={e => this.setState({ estrutura: e.target.value })}
                    />
                    <button type="submit"  onClick={e => this.setState({ button: "Simulando..." })}>{this.state.button}</button>
                    <hr />
                    Desenvolvimento por <strong> <a target={"_blank"} href={"https://lucasgoiana.com/"}>Lucas Goiana Malicia</a></strong>
                </Form>
            </Container>
        );
    }
}

export default withRouter(Simulate);