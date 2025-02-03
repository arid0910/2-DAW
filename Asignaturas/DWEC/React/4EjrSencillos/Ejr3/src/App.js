import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button, Popover, PopoverTrigger, PopoverContent } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props) {
    super(props)

    this.state = {

    }
  }

  render() {
    return (
      <div className="App">
        <Popover
          id="popover-basic"
          placement="right"
          positionLeft={200}
          positionTop={50}
          title="Popover right"
        >
          And here's some <strong>amazing</strong> content. It's very engaging. right?
        </Popover>
      </div>
    );
  }
}
export default App;