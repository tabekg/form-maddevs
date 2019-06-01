import React from 'react';
import { Card } from 'react-bootstrap';
import "./Topic.css";
import { Link } from 'react-router-dom';

class Topic extends React.Component {
  render(){
    return <Card body className="topic">
      <Card.Title>Title</Card.Title>
      <Card.Text className="topic-info">
        <div>Автор: <Link to="/">Author Name</Link></div>
        <div>Посты: <strong>0</strong></div>
      </Card.Text>
    </Card>;
  }
}

export default Topic;
