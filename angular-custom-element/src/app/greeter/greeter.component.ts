import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-greeter',
  templateUrl: './greeter.component.html',
  styleUrls: ['./greeter.component.css']
})
export class GreeterComponent implements OnInit {

  @Input()
  public name: string;
  constructor() { }

  ngOnInit() {
  }

}
