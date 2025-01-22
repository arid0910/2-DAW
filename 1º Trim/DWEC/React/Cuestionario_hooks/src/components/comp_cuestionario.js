import {Card, CardTitle, CardText, Button, CardSubtitle } from 'reactstrap';
import "../App.css"

export default function Cuestionario(props) {
  return (
    <>
      {props.listaPre.map((preguntas) => (
        <Card className="bottom" body>
          <CardTitle tag="h5">Cuestionario de Adicción al Móvil</CardTitle>
          <CardSubtitle><strong>Pregunta {preguntas.id}</strong></CardSubtitle>
          <CardText>{preguntas.pregunta}</CardText>
          <CardText>
            <Button className='right' color="primary" onClick={() => props.click("Si", preguntas.id)}>Sí</Button>
            <Button className='right' color="secondary" onClick={() => props.click("No", preguntas.id)}>No</Button>
          </CardText>
        </Card>
      ))}
    </>
  );
}
