import styled from "styled-components";

export const Container = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
`;

export const Form = styled.form`
  width: 400px;
  background: #fff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  img {
    width: 100px;
    margin: 10px 0 40px;
  }
  p {
    color: black;
    margin-bottom: 16px;
    padding: 0px;
    width: 100%;
    text-align: Left;
  }
  a.button {
    color: #fff;
    font-size: 16px;
    background: #256cdb;
    height: 56px;
    border: 0;
    border-radius: 5px;
    width: 100%;
    text-align: center;
    padding-top: 20px;
    text-decoration: none;
  }
  a{
    font-size:14px;
    color: black;
    text-decoration: underline;
  }
  hr {
    margin: 20px 0;
    border: none;
    border-bottom: 1px solid #cdcdcd;
    width: 100%;
  }
 
`;