import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import React, { Component } from 'react';
import './App.css'; 

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      matrixBtn: Array(9).fill("").map(() => Array(9).fill("")),
      matrixColor: Array(9).fill("").map(() => Array(9).fill("info")),
      colores: ["primary", "secondary", "danger", "warning", "success"],
    };
  }

  handlerOnClick(row, col){
    let auxColor = this.state.matrixColor.map(row => [...row])
    let cont = 0
    auxColor[row][col] = colores[cont++]

    this.setState({
      matrixColor:auxColor
    })
  }

  render() {
    return (
      <div className="grid">
        {this.state.matrixBtn.map((value, rowIndex) => (
         value.map((value, colIndex) => (
          <Button className="button" color={this.state.matrixColor[rowIndex][colIndex]}  onClick={() => this.handlerOnClick(rowIndex, colIndex)}></Button>
         ))
        ))}
      </div>
    );
  }
}

export default App;
