import React, { Component } from "react";
import { Link, withRouter } from "react-router-dom";
import Logo from "../../assets/images/logo.588a3bb9.png";

import { Form, Container } from "./styles";
import api from "../../services/api";

class SignUp extends Component {
    fruits_list = this.props.location.parcelamento
    state = {
        economia: "a",
        email: "",
        password: "",
        error: ""
    };


    render() {
        return (
            <Container>
                <Form>
                    <img src={Logo} alt="77Sol logo" />
                    <h2>Resultado</h2>
                    <hr/>
                    <p><strong>Economia:</strong>  {   this.props.location.economia} </p>
                    <p><strong>Potencial:</strong>  {   this.props.location.potencial}</p>
                    <p><strong>Parcelamento:</strong>

                        {this.fruits_list.map( (fruit,index)=>
                            (
                                <><li key={index}>{fruit}</li></>
                            )
                        )}
                    </p><br/>
                        <a className={'button'} href={"/simulate"} >Simular Novamente</a>
                    <hr/>
                    Desenvolvimento por <strong> <a target={"_blank"} href={"https://lucasgoiana.com/"}>Lucas Goiana Malicia</a></strong>
                </Form>
            </Container>
        );
    }
}

export default withRouter(SignUp);